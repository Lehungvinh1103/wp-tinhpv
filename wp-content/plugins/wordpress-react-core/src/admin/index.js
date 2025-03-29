/**
 * Admin area React application
 */
import React from 'react';
import { createRoot } from 'react-dom/client';
import AdminApp from './components/AdminApp';

// Wait for DOM to be ready
document.addEventListener('DOMContentLoaded', () => {
  // Find the root element
  const rootElement = document.getElementById('wp-react-core-admin-root');
  
  // Only proceed if the root element exists
  if (rootElement) {
    // Create a root
    const root = createRoot(rootElement);
    
    // Render the app
    root.render(
      <React.StrictMode>
        <AdminApp />
      </React.StrictMode>
    );
    
    console.log('WordPress React Core Admin app initialized');
  } else {
    console.error('WordPress React Core Admin app root element not found');
  }
});