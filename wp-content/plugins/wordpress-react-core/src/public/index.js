/**
 * Frontend React application
 */
import React from 'react';
import { createRoot } from 'react-dom/client';

// This file is intentionally minimal to reduce the size of the frontend bundle
// The public bundle is only used to provide React and other libraries to other plugins
// It does not render anything itself

// Export a render helper function
window.wpReactCore = window.wpReactCore || {};
window.wpReactCore.renderComponent = (Component, elementId, props = {}) => {
  const element = document.getElementById(elementId);
  if (element) {
    const root = createRoot(element);
    root.render(<Component {...props} />);
    return true;
  }
  return false;
};

// Log initialization
console.log('WordPress React Core initialized on frontend');