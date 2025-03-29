import React, { useState, useEffect } from 'react';
import { Layout, Menu, Breadcrumb, Button, Spin, message, Switch, Card, Tabs, List, Typography, Tag } from 'antd';
import { 
  SettingOutlined, 
  ApiOutlined, 
  CodeOutlined, 
  InfoCircleOutlined,
  CheckCircleOutlined,
  CloseCircleOutlined
} from '@ant-design/icons';

import { reactCoreApi } from '../../shared/api/wp-api';
import SettingsPanel from './SettingsPanel';
import ScriptsPanel from './ScriptsPanel';
import ApiPanel from './ApiPanel';
import AboutPanel from './AboutPanel';

const { Header, Content, Footer, Sider } = Layout;
const { Title } = Typography;

const AdminApp = () => {
  const [collapsed, setCollapsed] = useState(false);
  const [loading, setLoading] = useState(true);
  const [settings, setSettings] = useState({});
  const [status, setStatus] = useState({});
  const [activeTab, setActiveTab] = useState('settings');
  
  // Load settings on component mount
  useEffect(() => {
    const loadData = async () => {
      try {
        setLoading(true);
        
        // Load settings and status
        const [settingsData, statusData] = await Promise.all([
          reactCoreApi.getSettings(),
          reactCoreApi.getStatus()
        ]);
        
        setSettings(settingsData);
        setStatus(statusData);
      } catch (error) {
        console.error('Error loading data:', error);
        message.error('Failed to load plugin data');
      } finally {
        setLoading(false);
      }
    };
    
    loadData();
  }, []);
  
  // Handle settings update
  const handleSettingsUpdate = async (newSettings) => {
    try {
      setLoading(true);
      
      // Update settings
      const response = await reactCoreApi.updateSettings(newSettings);
      
      // Update local state
      setSettings(response.options);
      
      // Show success message
      message.success('Settings saved successfully');
      
      // Reload page to apply new settings
      window.location.reload();
    } catch (error) {
      console.error('Error updating settings:', error);
      message.error('Failed to update settings');
    } finally {
      setLoading(false);
    }
  };
  
  // Render loading state
  if (loading) {
    return (
      <div style={{ textAlign: 'center', padding: '50px' }}>
        <Spin size="large" />
        <p>Loading WordPress React Core...</p>
      </div>
    );
  }
  
  // Render main UI
  return (
    <Layout style={{ minHeight: '100vh' }}>
      <Sider collapsible collapsed={collapsed} onCollapse={setCollapsed}>
        <div className="logo" style={{ height: '32px', margin: '16px', background: 'rgba(255, 255, 255, 0.3)' }} />
        <Menu theme="dark" selectedKeys={[activeTab]} mode="inline">
          <Menu.Item key="settings" icon={<SettingOutlined />} onClick={() => setActiveTab('settings')}>
            Settings
          </Menu.Item>
          <Menu.Item key="scripts" icon={<CodeOutlined />} onClick={() => setActiveTab('scripts')}>
            Scripts & Styles
          </Menu.Item>
          <Menu.Item key="api" icon={<ApiOutlined />} onClick={() => setActiveTab('api')}>
            API
          </Menu.Item>
          <Menu.Item key="about" icon={<InfoCircleOutlined />} onClick={() => setActiveTab('about')}>
            About
          </Menu.Item>
        </Menu>
      </Sider>
      <Layout className="site-layout">
        <Header className="site-layout-background" style={{ padding: 0, background: '#fff' }}>
          <Title level={3} style={{ margin: '16px 24px' }}>WordPress React Core</Title>
        </Header>
        <Content style={{ margin: '0 16px' }}>
          <Breadcrumb style={{ margin: '16px 0' }}>
            <Breadcrumb.Item>WordPress React Core</Breadcrumb.Item>
            <Breadcrumb.Item>
              {activeTab === 'settings' && 'Settings'}
              {activeTab === 'scripts' && 'Scripts & Styles'}
              {activeTab === 'api' && 'API'}
              {activeTab === 'about' && 'About'}
            </Breadcrumb.Item>
          </Breadcrumb>
          <div className="site-layout-background" style={{ padding: 24, minHeight: 360, background: '#fff' }}>
            {activeTab === 'settings' && (
              <SettingsPanel 
                settings={settings} 
                onUpdate={handleSettingsUpdate} 
              />
            )}
            
            {activeTab === 'scripts' && (
              <ScriptsPanel 
                status={status} 
              />
            )}
            
            {activeTab === 'api' && (
              <ApiPanel />
            )}
            
            {activeTab === 'about' && (
              <AboutPanel 
                version={status.version} 
                libraries={status.libraries} 
              />
            )}
          </div>
        </Content>
        <Footer style={{ textAlign: 'center' }}>
          WordPress React Core v{status.version} | Made with ❤️ by You
        </Footer>
      </Layout>
    </Layout>
  );
};

export default AdminApp;