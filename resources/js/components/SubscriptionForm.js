import React, {useState} from 'react';
import {Form, Button, Row, Alert} from 'react-bootstrap';
import axios from 'axios';

const SubscriptionForm = () => {
    const [email, setEmail] = useState('');
    const [price, setPrice] = useState('');
    const [success, setSuccess] = useState(false);
    const [errors, setErrors] = useState(false);

    const handleSubmit = (event) => {
        event.preventDefault();

        const payload = {
            email,
            if_price_is_above: price,
        };

        axios.post('/api/subscriptions', payload)
            .then(() => {
                setSuccess(true);
                setErrors(false);
            })
            .catch((error) => {
                setSuccess(false);
                setErrors(error.response.data.errors);
            });
    };

    return (
        <>
            <Row>
                <h3>Do you want to get notified each time the price of BTC goes above a specific limit?</h3>
                <p>Subscribe now and we'll send you an email whenever this happens. Just submit your email and the
                    desired threshold.</p>
            </Row>
            <Row>
                {success && (
                    <Alert variant="success">
                        Subscription successful!
                    </Alert>
                )}

                {errors && (
                    <Alert variant="danger">
                        There are errors in the form!
                    </Alert>
                )}
            </Row>
            <Row>
                <Form onSubmit={handleSubmit}>
                    <Form.Group controlId="formEmail">
                        <Form.Label>Email address</Form.Label>
                        <Form.Control
                            type="email"
                            placeholder="Enter email"
                            value={email}
                            onChange={(e) => setEmail(e.target.value)}
                            required
                        />
                        {errors && 'email' in errors && (
                            <div className="text-danger">
                                <small>{errors.email[0]}</small>
                            </div>
                        )}
                    </Form.Group>

                    <Form.Group controlId="formPrice">
                        <Form.Label>Price threshold</Form.Label>
                        <Form.Control
                            type="number"
                            placeholder="Enter price threshold"
                            value={price}
                            onChange={(e) => setPrice(e.target.value)}
                            required
                        />
                        {errors && 'if_price_is_above' in errors && (
                            <div className="text-danger">
                                <small>{errors.if_price_is_above[0]}</small>
                            </div>
                        )}
                    </Form.Group>

                    <br/>
                    <Button variant="primary" type="submit">
                        Subscribe
                    </Button>
                </Form>
            </Row>
        </>
    );
};

export default SubscriptionForm;
