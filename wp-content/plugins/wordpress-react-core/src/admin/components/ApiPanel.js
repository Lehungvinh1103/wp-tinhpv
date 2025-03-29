import React from 'react';
import { Card, Typography, Table, Tag, Tabs, Collapse } from 'antd';
import { ApiOutlined, CodeOutlined } from '@ant-design/icons';

const { Title, Paragraph, Text } = Typography;
const { Panel } = Collapse;

const ApiPanel = () => {
    // Define endpoints for the API reference
    const endpoints = [
        {
            key: '1',
            endpoint: '/wp-react-core/v1/settings',
            method: 'GET',
            description: 'Get plugin settings',
            permission: 'manage_options',
            example: `
// Example JavaScript code using wp-api
const settings = await fetch('/wp-json/wp-react-core/v1/settings', {
  method: 'GET',
  headers: {
    'X-WP-Nonce': wpApiSettings.nonce,
    'Content-Type': 'application/json'
  }
}).then(res => res.json());

console.log(settings);
`
        },
        {
            key: '2',
            endpoint: '/wp-react-core/v1/settings',
            method: 'POST',
            description: 'Update plugin settings',
            permission: 'manage_options',
            example: `
// Example JavaScript code using wp-api
const response = await fetch('/wp-json/wp-react-core/v1/settings', {
  method: 'POST',
  headers: {
    'X-WP-Nonce': wpApiSettings.nonce,
    'Content-Type': 'application/json'
  },
  body: JSON.stringify({
    wp_react_core_enabled: true,
    include_tailwind: true,
    include_antd: true,
    include_axios: true
  })
}).then(res => res.json());

console.log(response);
`
        },
        {
            key: '3',
            endpoint: '/wp-react-core/v1/scripts/registered',
            method: 'GET',
            description: 'Check if a script is registered',
            permission: 'public',
            example: `
// Example JavaScript code using wp-api
const check = await fetch('/wp-json/wp-react-core/v1/scripts/registered?handle=react', {
  method: 'GET',
  headers: {
    'X-WP-Nonce': wpApiSettings.nonce,
    'Content-Type': 'application/json'
  }
}).then(res => res.json());

console.log(check);
`
        },
        {
            key: '4',
            endpoint: '/wp-react-core/v1/scripts',
            method: 'GET',
            description: 'Get all registered scripts',
            permission: 'manage_options',
            example: `
// Example JavaScript code using wp-api
const scripts = await fetch('/wp-json/wp-react-core/v1/scripts', {
  method: 'GET',
  headers: {
    'X-WP-Nonce': wpApiSettings.nonce,
    'Content-Type': 'application/json'
  }
}).then(res => res.json());

console.log(scripts);
`
        },
        {
            key: '5',
            endpoint: '/wp-react-core/v1/status',
            method: 'GET',
            description: 'Get plugin status',
            permission: 'public',
            example: `
// Example JavaScript code using wp-api
const status = await fetch('/wp-json/wp-react-core/v1/status', {
  method: 'GET',
  headers: {
    'X-WP-Nonce': wpApiSettings.nonce,
    'Content-Type': 'application/json'
  }
}).then(res => res.json());

console.log(status);
`
        }
    ];

    // Define columns for the endpoints table
    const columns = [
        {
            title: 'Endpoint',
            dataIndex: 'endpoint',
            key: 'endpoint',
            render: text => <Text code>{text}</Text>
        },
        {
            title: 'Method',
            dataIndex: 'method',
            key: 'method',
            render: method => {
                let color = 'default';
                if (method === 'GET') color = 'blue';
                if (method === 'POST') color = 'green';
                if (method === 'PUT') color = 'orange';
                if (method === 'DELETE') color = 'red';

                return <Tag color={color}>{method}</Tag>;
            }
        },
        {
            title: 'Description',
            dataIndex: 'description',
            key: 'description'
        },
        {
            title: 'Permission',
            dataIndex: 'permission',
            key: 'permission',
            render: perm => {
                let color = perm === 'public' ? 'green' : 'blue';
                return <Tag color={color}>{perm}</Tag>;
            }
        }
    ];

    // Helper function for the JS utility code
    const utilityCode = `
// wp-api.js - Utility functions for WordPress REST API

/**
 * Base API helper for making WordPress REST API requests
 */
export const wpApi = {
  /**
   * Make a GET request to WordPress REST API
   *
   * @param {string} path - API endpoint path
   * @param {Object} params - Query parameters
   * @returns {Promise<any>} - API response
   */
  get: async (path, params = {}) => {
    // Build query string
    const queryString = Object.keys(params)
      .map(key => \`\${encodeURIComponent(key)}=\${encodeURIComponent(params[key])}\`)
      .join('&');
    
    const url = \`\${wpApiSettings.root}\${path}\${queryString ? \`?\${queryString}\` : ''}\`;
    
    // Make the request
    const response = await fetch(url, {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json',
        'X-WP-Nonce': wpApiSettings.nonce
      }
    });
    
    // Check if the request was successful
    if (!response.ok) {
      throw new Error(\`API Error: \${response.status} \${response.statusText}\`);
    }
    
    // Parse and return the JSON response
    return await response.json();
  },
  
  /**
   * Make a POST request to WordPress REST API
   *
   * @param {string} path - API endpoint path
   * @param {Object} data - Data to send
   * @returns {Promise<any>} - API response
   */
  post: async (path, data = {}) => {
    const url = \`\${wpApiSettings.root}\${path}\`;
    
    // Make the request
    const response = await fetch(url, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-WP-Nonce': wpApiSettings.nonce
      },
      body: JSON.stringify(data)
    });
    
    // Check if the request was successful
    if (!response.ok) {
      throw new Error(\`API Error: \${response.status} \${response.statusText}\`);
    }
    
    // Parse and return the JSON response
    return await response.json();
  }
};

/**
 * React Core API helper
 */
export const reactCoreApi = {
  /**
   * Get plugin settings
   *
   * @returns {Promise<Object>} - Plugin settings
   */
  getSettings: async () => {
    return await wpApi.get('/wp-react-core/v1/settings');
  },
  
  /**
   * Update plugin settings
   *
   * @param {Object} settings - New settings
   * @returns {Promise<Object>} - Updated settings
   */
  updateSettings: async (settings) => {
    return await wpApi.post('/wp-react-core/v1/settings', settings);
  },
  
  /**
   * Check if a script is registered
   *
   * @param {string} handle - Script handle
   * @returns {Promise<Object>} - Check result
   */
  isScriptRegistered: async (handle) => {
    return await wpApi.get(\`/wp-react-core/v1/scripts/registered\`, { handle });
  },
  
  /**
   * Get all registered scripts
   *
   * @returns {Promise<Array>} - Registered scripts
   */
  getRegisteredScripts: async () => {
    return await wpApi.get('/wp-react-core/v1/scripts');
  },
  
  /**
   * Get plugin status
   *
   * @returns {Promise<Object>} - Plugin status
   */
  getStatus: async () => {
    return await wpApi.get('/wp-react-core/v1/status');
  }
};
`;

    return (
        <div>
            <Title level={4}>API Reference</Title>
            <Paragraph>
                WordPress React Core provides REST API endpoints that you can use to interact with the plugin programmatically.
                These endpoints are available to other plugins and themes.
            </Paragraph>

            <Card title="REST API Endpoints" style={{ marginBottom: '20px' }}>
                <Table
                    columns={columns}
                    dataSource={endpoints}
                    rowKey="key"
                    expandable={{
                        expandedRowRender: record => (
                            <Card type="inner" title="Example Usage">
                                <pre style={{ backgroundColor: '#f5f5f5', padding: '12px', borderRadius: '4px' }}>
                                    <code>{record.example}</code>
                                </pre>
                            </Card>
                        )
                    }}
                />
            </Card>

            <Card title="JavaScript Utility Functions">
                <Paragraph>
                    WordPress React Core provides JavaScript utility functions that you can use to interact with the WordPress REST API.
                    You can copy and use these functions in your own plugins or themes.
                </Paragraph>

                <Collapse defaultActiveKey={['1']}>
                    <Panel header="JavaScript API Utilities" key="1">
                        <pre style={{ backgroundColor: '#f5f5f5', padding: '12px', borderRadius: '4px' }}>
                            <code>{utilityCode}</code>
                        </pre>
                    </Panel>
                </Collapse>
            </Card>
        </div>
    );
};

export default ApiPanel;