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