
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        .header {
            width: 100%;
            background-color: white;
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
        }
        .container {
            width: 100%;
            max-width: 1000px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo {
            display: flex;
            align-items: center;
        }
        .logo img {
            height: 60px;
            margin-right: 10px;
        }
        .logo-text {
            display: flex;
            flex-direction: column;
        }
        .logo-text h1 {
            color: #dd0000;
            font-size: 20px;
            margin: 0;
            line-height: 1;
        }
        .logo-text p {
            color: #666;
            font-size: 12px;
            margin: 0;
        }
        .contact-info {
            text-align: center;
        }
        .contact-info h2 {
            font-size: 16px;
            margin: 0 0  0;
        }
        .contact-info p {
            font-size: 12px;
            margin: 0;
        }
        .shield img {            
            height: 60px;
        }
    </style>

    <header class="header">
        <div class="container">
            <div class="logo">
                <img src="{{asset('img/Logo-Escudo-de-Nemby.png')}}">                
            </div>
            <div class="contact-info">
                <h2><b>MUNICIPALIDAD DE ÑEMBY</b></h2>
                <p>INFO@NEMBY.GOV.PY</p>
                <p>(021) 960 - 300</p>
            </div>
            <div class="shield">
                <img src="http://nemby.gov.py/wp-content/uploads/2023/03/Logo-Escudo-de-Nemby.png">
            </div>
        </div>
    </header>
