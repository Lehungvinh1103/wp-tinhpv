import React from 'react';
import { Card, Typography, Divider, Row, Col, Tag, List, Space } from 'antd';
import { 
  CheckCircleOutlined, 
  CloseCircleOutlined, 
  GithubOutlined, 
  CodeOutlined,
  BookOutlined,
  QuestionCircleOutlined 
} from '@ant-design/icons';

const { Title, Paragraph, Text, Link } = Typography;

const AboutPanel = ({ version, libraries }) => {
  // Define features list
  const features = [
    'Shared React library for all WordPress plugins',
    'Compatible with WordPress blocks and classic editor',
    'Ready-to-use UI components with Ant Design',
    'Responsive layouts with TailwindCSS',
    'REST API integration with Axios',
    'Simple plugin API for third-party plugins',
    'Admin interface built with React',
    'Frontend components support'
  ];
  
  // Define usage examples
  const usageExamples = [
    {
      title: 'Basic React Component',
      content: `
// In your plugin's JavaScript file
import React from 'react';
import { createRoot } from 'react-dom/client';

// Create your component
const MyComponent = () => {
  return <div>Hello from React!</div>;
};

// Render your component
const rootElement = document.getElementById('my-plugin-root');
if (rootElement) {
  const root = createRoot(rootElement);
  root.render(<MyComponent />);
}
      `
    },
    {
      title: 'Using Ant Design',
      content: `
// In your plugin's JavaScript file
import React from 'react';
import { createRoot } from 'react-dom/client';
import { Button, Table, Card } from 'antd';

// Create your component
const MyComponent = () => {
  return (
    <Card title="My Plugin">
      <Button type="primary">Click me</Button>
    </Card>
  );
};

// Render your component
const rootElement = document.getElementById('my-plugin-root');
if (rootElement) {
  const root = createRoot(rootElement);
  root.render(<MyComponent />);
}
      `
    },
    {
      title: 'Using REST API',
      content: `
// In your plugin's JavaScript file
import React, { useState, useEffect } from 'react';
import { createRoot } from 'react-dom/client';
import { Table, Spin } from 'antd';
import axios from 'axios';

// Create your component
const MyComponent = () => {
  const [data, setData] = useState([]);
  const [loading, setLoading] = useState(true);
  
  useEffect(() => {
    const fetchData = async () => {
      try {
        const response = await axios.get('/wp-json/wp/v2/posts');
        setData(response.data);
      } catch (error) {
        console.error(error);
      } finally {
        setLoading(false);
      }
    };
    
    fetchData();
  }, []);
  
  if (loading) {
    return <Spin />;
  }
  
  return (
    <Table
      dataSource={data}
      columns={[
        {
          title: 'Title',
          dataIndex: 'title',
          key: 'title',
          render: title => title.rendered
        },
        {
          title: 'Date',
          dataIndex: 'date',
          key: 'date'
        }
      ]}
    />
  );
};

// Render your component
const rootElement = document.getElementById('my-plugin-root');
if (rootElement) {
  const root = createRoot(rootElement);
  root.render(<MyComponent />);
}
      `
    }
  ];
  
  return (
    <div>
      <Title level={4}>About WordPress React Core</Title>
      <Paragraph>
        WordPress React Core is a plugin that provides React and other modern JavaScript libraries to WordPress plugins and themes.
        It allows developers to use React, Ant Design, TailwindCSS, and Axios in their plugins without having to include these libraries themselves.
      </Paragraph>
      
      <Card style={{ marginBottom: '20px' }}>
        <Row gutter={[16, 16]}>
          <Col span={8}>
            <Title level={5}>Version</Title>
            <Paragraph>
              <Tag color="blue">{version}</Tag>
            </Paragraph>
          </Col>
          
          <Col span={16}>
            <Title level={5}>Libraries</Title>
            <Space>
              <Tag color="blue" icon={<CheckCircleOutlined />}>React</Tag>
              <Tag color="blue" icon={<CheckCircleOutlined />}>React DOM</Tag>
              <Tag color={libraries?.axios ? 'blue' : 'default'} icon={libraries?.axios ? <CheckCircleOutlined /> : <CloseCircleOutlined />}>
                Axios
              </Tag>
              <Tag color={libraries?.antd ? 'blue' : 'default'} icon={libraries?.antd ? <CheckCircleOutlined /> : <CloseCircleOutlined />}>
                Ant Design
              </Tag>
              <Tag color={libraries?.tailwind ? 'blue' : 'default'} icon={libraries?.tailwind ? <CheckCircleOutlined /> : <CloseCircleOutlined />}>
                TailwindCSS
              </Tag>
            </Space>
          </Col>
        </Row>
      </Card>
      
      <Card title="Features" style={{ marginBottom: '20px' }}>
        <List
          grid={{ gutter: 16, column: 2 }}
          dataSource={features}
          renderItem={item => (
            <List.Item>
              <div>
                <CheckCircleOutlined style={{ color: '#52c41a', marginRight: 8 }} />
                {item}
              </div>
            </List.Item>
          )}
        />
      </Card>
      
      <Card title="Usage Examples" style={{ marginBottom: '20px' }}>
        {usageExamples.map((example, index) => (
          <div key={index} style={{ marginBottom: index < usageExamples.length - 1 ? 16 : 0 }}>
            <Title level={5}>{example.title}</Title>
            <pre style={{ backgroundColor: '#f5f5f5', padding: '12px', borderRadius: '4px' }}>
              <code>{example.content}</code>
            </pre>
            {index < usageExamples.length - 1 && <Divider />}
          </div>
        ))}
      </Card>
      
      <Card title="Resources">
        <Row gutter={[16, 16]}>
          <Col span={8}>
            <Title level={5}><BookOutlined /> Documentation</Title>
            <Paragraph>
              <Link href="#" target="_blank">View Documentation</Link>
            </Paragraph>
          </Col>
          
          <Col span={8}>
            <Title level={5}><GithubOutlined /> GitHub</Title>
            <Paragraph>
              <Link href="#" target="_blank">GitHub Repository</Link>
            </Paragraph>
          </Col>
          
          <Col span={8}>
            <Title level={5}><QuestionCircleOutlined /> Support</Title>
            <Paragraph>
              <Link href="#" target="_blank">Get Support</Link>
            </Paragraph>
          </Col>
        </Row>
      </Card>
    </div>
  );
};

export default AboutPanel;