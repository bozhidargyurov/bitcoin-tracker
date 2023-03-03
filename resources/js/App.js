import React from 'react';
import Layout from './components/Layout';
import Header from './components/Header';
import Footer from './components/Footer';
import HomePage from './components/HomePage';

function App() {
    return (
        <Layout header={<Header />} footer={<Footer />}>
            <HomePage />
        </Layout>
    );
}

export default App;
