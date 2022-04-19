## Log Counter

### Steps
<ul>
    <li>Clone repository <pre> git clone https://github.com/Vheekey/Log-Counter.git</pre> </li>
    <li>To run with composer <pre> docker-compose up</pre> </li>
    <li>To run without composer, skip the above step and run the following steps below: </li>
    <li> Create database <pre> php bin/console doctrine:database:create </pre> </li>
    <li> Run migration <pre> php bin/console doctrine:migrations:migrate </pre> </li>
    <li> Start server <pre> symfony server:start </pre> </li>
</ul>

### Sample request
<pre>
    https://localhost:8000/count?statusCode=201&serviceNames=INVOICE-SERVICE
</pre>

### Sample Response
<pre>
    [{"statusCode":"201","serviceName":"INVOICE-SERVICE","date":{"date":"2021-08-17 09:21:55.000000","timezone_type":3,"timezone":"UTC"},"endpoint":"\/invoices","method":"POST"},{"statusCode":"201","serviceName":"INVOICE-SERVICE","date":{"date":"2021-08-17 09:22:58.000000","timezone_type":3,"timezone":"UTC"},"endpoint":"\/invoices","method":"POST"},{"statusCode":"201","serviceName":"INVOICE-SERVICE","date":{"date":"2021-08-17 09:23:53.000000","timezone_type":3,"timezone":"UTC"},"endpoint":"\/invoices","method":"POST"},{"statusCode":"201","serviceName":"INVOICE-SERVICE","date":{"date":"2021-08-17 09:26:53.000000","timezone_type":3,"timezone":"UTC"},"endpoint":"\/invoices","method":"POST"},{"statusCode":"201","serviceName":"INVOICE-SERVICE","date":{"date":"2021-08-18 10:26:53.000000","timezone_type":3,"timezone":"UTC"},"endpoint":"\/invoices","method":"POST"}]
</pre>
