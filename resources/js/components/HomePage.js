import React from 'react';
import {Container} from 'react-bootstrap';
import BitcoinChart from "./BitcoinChart";
import SubscriptionForm from "./SubscriptionForm";

const HomePage = () => {
    return (
        <Container>
            <>
                <BitcoinChart/>
                <hr/>
                <SubscriptionForm/>
            </>
        </Container>
    );
};

export default HomePage;
