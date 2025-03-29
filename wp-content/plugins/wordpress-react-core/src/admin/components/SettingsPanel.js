import React, { useState } from 'react';
import { Card, Form, Switch, Button, Typography, Alert, Space, Divider } from 'antd';
import { 
  SaveOutlined, 
  ReloadOutlined,
  WarningOutlined 
} from '@ant-design/icons';

const { Title, Paragraph } = Typography;

const SettingsPanel = ({ settings, onUpdate }) => {
  const [form] = Form.useForm();
  const [formChanged, setFormChanged] = useState(false);
  
  // Initialize form with current settings
  React.useEffect(() => {
    form.setFieldsValue({
      wp_react_core_enabled: settings.wp_react_core_enabled ?? true,
      include_tailwind: settings.include_tailwind ?? true,
      include_antd: settings.include_antd ?? true,
      include_axios: settings.include_axios ?? true
    });
  }, [settings, form]);
  
  // Handle form submission
  const handleSubmit = (values) => {
    onUpdate(values);
    setFormChanged(false);
  };
  
  // Handle form change
  const handleFormChange = () => {
    setFormChanged(true);
  };
  
  // Handle form reset
  const handleReset = () => {
    form.setFieldsValue({
      wp_react_core_enabled: settings.wp_react_core_enabled ?? true,
      include_tailwind: settings.include_tailwind ?? true,
      include_antd: settings.include_antd ?? true,
      include_axios: settings.include_axios ?? true
    });
    setFormChanged(false);
  };
  
  return (
    <div>
      <Title level={4}>Plugin Settings</Title>
      <Paragraph>
        Configure which libraries to include in your WordPress site. Changes will take effect immediately after saving.
      </Paragraph>
      
      <Alert
        message="Warning"
        description="Disabling libraries that are in use by other plugins may cause them to stop working."
        type="warning"
        showIcon
        icon={<WarningOutlined />}
        style={{ marginBottom: '20px' }}
      />
      
      <Card>
        <Form
          form={form}
          layout="vertical"
          onFinish={handleSubmit}
          onValuesChange={handleFormChange}
          initialValues={{
            wp_react_core_enabled: true,
            include_tailwind: true,
            include_antd: true,
            include_axios: true
          }}
        >
          <Form.Item
            name="wp_react_core_enabled"
            label="Enable WordPress React Core"
            valuePropName="checked"
          >
            <Switch />
          </Form.Item>
          
          <Divider />
          
          <Form.Item
            name="include_react"
            label="Include React & React DOM"
            valuePropName="checked"
            tooltip="React and React DOM are always included and cannot be disabled"
          >
            <Switch disabled defaultChecked />
          </Form.Item>
          
          <Form.Item
            name="include_tailwind"
            label="Include TailwindCSS"
            valuePropName="checked"
          >
            <Switch />
          </Form.Item>
          
          <Form.Item
            name="include_antd"
            label="Include Ant Design"
            valuePropName="checked"
          >
            <Switch />
          </Form.Item>
          
          <Form.Item
            name="include_axios"
            label="Include Axios"
            valuePropName="checked"
          >
            <Switch />
          </Form.Item>
          
          <Form.Item>
            <Space>
              <Button
                type="primary"
                htmlType="submit"
                icon={<SaveOutlined />}
                disabled={!formChanged}
              >
                Save Settings
              </Button>
              
              <Button
                onClick={handleReset}
                icon={<ReloadOutlined />}
                disabled={!formChanged}
              >
                Reset
              </Button>
            </Space>
          </Form.Item>
        </Form>
      </Card>
    </div>
  );
};

export default SettingsPanel;