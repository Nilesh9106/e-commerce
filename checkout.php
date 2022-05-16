<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>checkout</title>
    <?php include "comp/link.php" ?>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap');

        * {
            margin: 0;
            padding: 0;
        }

        .container {
            min-height: 100vh;
            background-color: #f7f7f9;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            height: auto;
            width: 90%;
            border-radius: 10px;
            background-color: #fff;
            padding: 0 20px;
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        .payment-details {
            margin-top: 20px;
        }

        .payment-details p {
            font-size: 16px;
            font-weight: 700;
            color: black;
        }

        .input-text {
            position: relative;
            margin-top: 30px;
        }

        input[type="text"] {

            height: 40px;
            width: 100%;
            border-radius: 5px;
            border: none;
            outline: 0;
            border: 1px solid #f6f6f7;
            padding: 0 10px;
            box-sizing: border-box;
            font-size: 16px;
        }

        .input-text span {
            position: absolute;
            top: -16px;
            left: 10px;
            font-size: 16px;
            font-weight: 600;
        }

        .input-text-cvv {
            position: relative;
        }

        .input-text-cvv input[type="text"] {
            height: 40px;
            width: 70px;
            /* border: none; */

            border-bottom: 1px solid #f6f6f7;
            border-top: 1px solid #f6f6f7;
            position: absolute;
            top: -40px;
            right: 60px;
        }

        .cvv input[type="text"] {
            position: absolute;
            right: 0;
            border-right: 1px solid #f6f6f7;
        }

        .billing {
            margin-top: 30px;
            position: relative;
        }

        .billing span {
            font-size: 16px;
            font-weight: 700;
            position: absolute;
            top: -16px;
            left: 10px;
        }

        .billing select {
            height: 35px;
            width: 100%;
            font-size: 16px;
            outline: 0;
            padding-left: 5px;
            border: 1px solid #f6f6f7;
            cursor: pointer;
        }

        .billing select option:nth-child(1) {
            display: none;

        }

        .zip-state {
            display: flex;
            width: 100%;
        }

        .zip {
            width: 50%;
        }

        .zip input[type="text"] {
            height: 35px;
        }

        .state {
            width: 50%;
        }

        .summary {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }

        .text-data p {
            margin-top: 3px;
            font-size: 16px;
            font-weight: 600;
        }

        .numerical-data p {
            margin-top: 3px;
            font-size: 16px;
            font-weight: 600;
        }

        .pay {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }


        

        .secure {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            /*text-align:center;*/
            color: black;
        }

        .secure p {
            font-size: 16px;
            font-weight: 600;
            color: black;
            margin-left: 5px;
        }

        .last {
            margin-top: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 16px;
            font-weight: 700;
        }

        .last p {
            margin-right: 5px;
        }

        .last a {
            color: blue;
            text-decoration: none;
            margin-left: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="payment-details">
                <h3>Payment Details</h3>
                <p>Complete your purchase by providing your payment details.</p>
            </div>
            <div class="input-text">
                <input type="text" placeholder="luke@skywalker.com">
                <span>Email</span>
            </div>
            <div class="input-text">
                <input type="text" placeholder="0000 0000 0000 0000" data-slots="0" data-accept="\d">
                <span>Card Details</span>
            </div>
            <div class="input-text-cvv">
                <input type="text" placeholder="mm/yyyy" data-slots="my">
                <!--<span>Card Details</span>-->
            </div>
            <div class="input-text-cvv cvv">
                <input type="text" placeholder="000" data-slots="0" data-accept="\d" size="3">
                <!--<span>Card Details</span>-->
            </div>
            <div class="input-text">
                <input type="text" placeholder="Username">
                <span>Card Holder name</span>
            </div>
            <div class="billing">
                <span>Billing Address</span>
                <select>
                    <option>Select Country</option>
                    <option>United States</option>
                    <option>India</option>
                    <option>England</option>
                    <option>France</option>
                    <option>Germany</option>
                    <option>Japan</option>
                    <option>China</option>
                    <option>Italy</option>
                    <option>Russia</option>
                </select>
                <div class="zip-state">
                    <div class="zip">
                        <input type="text" placeholder="ZIP">
                    </div>
                    <div class="state">
                        <select>
                            <option>Select State</option>
                            <option>New York</option>
                            <option>New Delhi</option>
                            <option>London</option>
                            <option>Paris</option>
                            <option>Berlin</option>
                            <option>Tokyo</option>
                            <option>Bejing</option>
                            <option>Rome</option>
                            <option>Mosco</option>
                        </select>
                    </div>

                </div>
            </div>
            <div class="input-text">
                <input type="text" placeholder="GB0124589">
                <span>Vat Number</span>
            </div>
            <div class="input-text">
                <input type="text" placeholder="BLACKWEDNESDAY">
                <span>Discount code</span>
            </div>
            <div class="summary">
                <div class="text-data">
                    <p>Subtotal</p>
                    <p>Discount</p>
                    <p>VAT(20%)</p>
                    <h5>Total</h5>
                </div>
                <div class="numerical-data">
                    <p>$19.00</p>
                    <p>$5.00</p>
                    <p>$2.80</p>
                    <h5>$16.80</h5>
                </div>
            </div>
            <div class="pay">
                <button class="btn btn-primary w-100">Pay</button>
            </div>
            <div class="secure">
                <i class="fa fa-lock"></i>
                <p> Payments are secured and encrypted</p>
            </div>
            <div class="last">
                <p>Powered by Orman Clark</p>
                <a href="#"> Terms </a>
                <a href="#"> Privacy </a>
            </div>

        </div>

    </div>
</body>

</html>