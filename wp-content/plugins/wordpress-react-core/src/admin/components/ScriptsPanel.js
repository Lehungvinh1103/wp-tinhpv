import React, { useState, useEffect } from 'react';
import { Card, Table, Tag, Typography, Input, Button, Space } from 'antd';
import { SearchOutlined, ReloadOutlined } from '@ant-design/icons';
import { reactCoreApi } from '../../shared/api/wp-api';

const { Title, Paragraph } = Typography;

const ScriptsPanel = ({ status }) => {
  const [scripts, setScripts] = useState([]);
  const [loading, setLoading] = useState(false);
  const [searchText, setSearchText] = useState('');
  
  // Load scripts data
  const loadScripts = async () => {
    try {
      setLoading(true);
      const data = await reactCoreApi.getRegisteredScripts();
      setScripts(data);
    } catch (error) {
      console.error('Error loading scripts:', error);
    } finally {
      setLoading(false);
    }
  };
  
  // Load scripts on component mount
  useEffect(() => {
    loadScripts();
  }, []);
  
  // Handle search input change
  const handleSearchChange = (e) => {
    setSearchText(e.target.value);
  };
  
  // Filter scripts based on search text
  const filteredScripts = scripts.filter(script => 
    script.handle.toLowerCase().includes(searchText.toLowerCase()) ||
    (script.src && script.src.toLowerCase().includes(searchText.toLowerCase()))
  );
  
  // Define columns for the scripts table
  const columns = [
    {
      title: 'Handle',
      dataIndex: 'handle',
      key: 'handle',
      sorter: (a, b) => a.handle.localeCompare(b.handle),
      render: (text, record) => {
        // Check if it's a core script
        const isCoreScript = 
          text === 'react' || 
          text === 'react-dom' || 
          text === 'axios' || 
          text === 'antd' || 
          text.startsWith('wp-react-core');
        
        return (
          <span>
            {text}
            {isCoreScript && (
              <Tag color="blue" style={{ marginLeft: 8 }}>
                Core
              </Tag>
            )}
          </span>
        );
      }
    },
    {
      title: 'Source',
      dataIndex: 'src',
      key: 'src',
      render: (text) => {
        if (!text) return <span>Inline script</span>;
        
        // Display only the last part of the URL for better readability
        const url = new URL(text.startsWith('http') ? text : `http://example.com${text}`);
        const path = url.pathname.split('/');
        const filename = path[path.length - 1];
        
        return (
          <span title={text}>
            {filename}
          </span>
        );
      }
    },
    {
      title: 'Version',
      dataIndex: 'ver',
      key: 'ver',
      sorter: (a, b) => {
        if (!a.ver) return -1;
        if (!b.ver) return 1;
        return a.ver.toString().localeCompare(b.ver.toString());
      }
    },
    {
      title: 'Dependencies',
      dataIndex: 'deps',
      key: 'deps',
      render: (deps) => (
        <span>
          {deps && deps.length > 0 ? (
            deps.map(dep => (
              <Tag key={dep} color="green">
                {dep}
              </Tag>
            ))
          ) : (
            <Tag color="default">None</Tag>
          )}
        </span>
      )
    }
  ];
  
  return (
    <div>
      <Title level={4}>Registered Scripts & Styles</Title>
      <Paragraph>
        This page shows all scripts and styles registered in WordPress, including those registered by WordPress React Core.
      </Paragraph>
      
      <Card title="Library Status" style={{ marginBottom: '20px' }}>
        <Space size="large">
          <div>
            <strong>React:</strong>{' '}
            {status.libraries?.react ? (
              <Tag color="success" icon={<SearchOutlined />}>Registered</Tag>
            ) : (
              <Tag color="error">Not Registered</Tag>
            )}
          </div>
          
          <div>
            <strong>React DOM:</strong>{' '}
            {status.libraries?.['react-dom'] ? (
              <Tag color="success" icon={<SearchOutlined />}>Registered</Tag>
            ) : (
              <Tag color="error">Not Registered</Tag>
            )}
          </div>
          
          <div>
            <strong>Axios:</strong>{' '}
            {status.libraries?.axios ? (
              <Tag color="success" icon={<SearchOutlined />}>Registered</Tag>
            ) : (
              <Tag color="error">Not Registered</Tag>
            )}
          </div>
          
          <div>
            <strong>Ant Design:</strong>{' '}
            {status.libraries?.antd ? (
              <Tag color="success" icon={<SearchOutlined />}>Registered</Tag>
            ) : (
              <Tag color="error">Not Registered</Tag>
            )}
          </div>
          
          <div>
            <strong>Tailwind CSS:</strong>{' '}
            {status.libraries?.tailwind ? (
              <Tag color="success" icon={<SearchOutlined />}>Registered</Tag>
            ) : (
              <Tag color="error">Not Registered</Tag>
            )}
          </div>
        </Space>
      </Card>
      
      <Card title="All Registered Scripts">
        <Space style={{ marginBottom: '16px' }}>
          <Input
            placeholder="Search scripts"
            value={searchText}
            onChange={handleSearchChange}
            prefix={<SearchOutlined />}
            style={{ width: '300px' }}
            allowClear
          />
          
          <Button
            icon={<ReloadOutlined />}
            onClick={loadScripts}
            loading={loading}
          >
            Refresh
          </Button>
        </Space>
        
        <Table
          columns={columns}
          dataSource={filteredScripts}
          rowKey="handle"
          loading={loading}
          pagination={{ pageSize: 10 }}
        />
      </Card>
    </div>
  );
};

export default ScriptsPanel;