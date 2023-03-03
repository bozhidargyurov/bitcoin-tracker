import React from 'react';

const Layout = ({ header, footer, children }) => {
    return (
        <div className="container">
            {header}
            <main>{children}</main>
            {footer}
        </div>
    );
};

export default Layout;
