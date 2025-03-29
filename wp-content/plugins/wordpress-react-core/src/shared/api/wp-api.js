/**
 * WordPress API utilities
 */

// Get the API URL and nonce from global object
const apiUrl = window.wpReactCore?.apiUrl || '/wp-json';
const nonce = window.wpReactCore?.nonce || '';

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
      .map(key => `${encodeURIComponent(key)}=${encodeURIComponent(params[key])}`)
      .join('&');
    
    const url = `${apiUrl}${path}${queryString ? `?${queryString}` : ''}`;
    
    // Make the request
    const response = await fetch(url, {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json',
        'X-WP-Nonce': nonce
      }
    });
    
    // Check if the request was successful
    if (!response.ok) {
      throw new Error(`API Error: ${response.status} ${response.statusText}`);
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
    const url = `${apiUrl}${path}`;
    
    // Make the request
    const response = await fetch(url, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-WP-Nonce': nonce
      },
      body: JSON.stringify(data)
    });
    
    // Check if the request was successful
    if (!response.ok) {
      throw new Error(`API Error: ${response.status} ${response.statusText}`);
    }
    
    // Parse and return the JSON response
    return await response.json();
  },
  
  /**
   * Make a PUT request to WordPress REST API
   *
   * @param {string} path - API endpoint path
   * @param {Object} data - Data to send
   * @returns {Promise<any>} - API response
   */
  put: async (path, data = {}) => {
    const url = `${apiUrl}${path}`;
    
    // Make the request
    const response = await fetch(url, {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json',
        'X-WP-Nonce': nonce
      },
      body: JSON.stringify(data)
    });
    
    // Check if the request was successful
    if (!response.ok) {
      throw new Error(`API Error: ${response.status} ${response.statusText}`);
    }
    
    // Parse and return the JSON response
    return await response.json();
  },
  
  /**
   * Make a DELETE request to WordPress REST API
   *
   * @param {string} path - API endpoint path
   * @returns {Promise<any>} - API response
   */
  delete: async (path) => {
    const url = `${apiUrl}${path}`;
    
    // Make the request
    const response = await fetch(url, {
      method: 'DELETE',
      headers: {
        'Content-Type': 'application/json',
        'X-WP-Nonce': nonce
      }
    });
    
    // Check if the request was successful
    if (!response.ok) {
      throw new Error(`API Error: ${response.status} ${response.statusText}`);
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
    return await wpApi.get(`/wp-react-core/v1/scripts/registered`, { handle });
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

// Export both API helpers
export default {
  wpApi,
  reactCoreApi
};