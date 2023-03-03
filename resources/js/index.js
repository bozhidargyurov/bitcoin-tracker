import React from 'react';
import { createRoot } from 'react-dom/client';
import 'bootstrap/dist/css/bootstrap.min.css';
import App from './App';

// Use createRoot to render the app
const root = document.getElementById('root');
if (root) {
    createRoot(root).render(<App />);
}
