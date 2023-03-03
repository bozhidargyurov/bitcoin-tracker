import React from 'react';

const Footer = () => {
    const year = new Date().getFullYear();
    return (
        <footer className="text-center text-capitalize">
            Bitcoin tracker &copy; {year}
        </footer>
    );
};

export default Footer;
