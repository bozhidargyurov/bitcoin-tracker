import React, { useState, useEffect } from 'react';
import { Line } from 'react-chartjs-2';
import axios from 'axios';
import moment from 'moment';
import {
    Chart as ChartJS,
    CategoryScale,
    LinearScale,
    PointElement,
    LineElement,
    Title,
    Tooltip,
    Legend,
} from 'chart.js';

ChartJS.register(
    CategoryScale,
    LinearScale,
    PointElement,
    LineElement,
    Title,
    Tooltip,
    Legend
);

const options = {
    responsive: true,
    plugins: {
        legend: {
            position: 'top',
        },
        title: {
            display: true,
            text: 'Bitcoin price trend in USD',
        },
    },
};

const BitcoinChart = () => {
    const [data, setData] = useState(null);

    useEffect(() => {
        axios.get('/api/bitcoin-trends')
            .then(response => {
                const chartData = {
                    labels: response.data.map(item => moment(item.created_at).format('MMM D, h:mm a')),
                    datasets: [
                        {
                            label: 'Bitcoin Price in USD',
                            data: response.data.map(item => item.price),
                            fill: false,
                            backgroundColor: 'rgb(255, 99, 132)',
                            borderColor: 'rgba(255, 99, 132, 0.2)',
                        },
                    ],
                };
                setData(chartData);
            })
            .catch(error => {
                console.log(error);
            });
    }, []);

    return (
        <div>
            {data && <Line options={options} data={data} />}
        </div>
    );
};

export default BitcoinChart;
