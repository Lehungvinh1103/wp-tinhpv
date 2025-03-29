/**
 * This file imports third-party libraries to be included in the vendor bundle
 * This helps reduce the size of other bundles and improves caching
 */

// React and React DOM
import React from 'react';
import ReactDOM from 'react-dom';
import { createRoot } from 'react-dom/client';

// Axios for HTTP requests
import axios from 'axios';

// Ant Design
import * as antd from 'antd';
import * as icons from '@ant-design/icons';

// Export libraries for global use
window.React = React;
window.ReactDOM = ReactDOM;
window.createRoot = createRoot;
window.axios = axios;
window.antd = antd;
window.icons = icons;

// Export all libraries
export {
  React,
  ReactDOM,
  createRoot,
  axios,
  antd,
  icons
};