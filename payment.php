<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Form | CropConnect</title>
    <link rel="icon" type="image/x-icon" href="images/cropconnect-favicon-color.ico">
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #90EE90;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        form {
            width: 90%;
            max-width: 700px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }

        select,
        input[type="text"],
        button {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        button {
            background-color: orange;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        button:hover {
            background-color: #2980b9;
        }

        .error {
            color: #e74c3c;
            font-size: 12px;
            margin-top: 5px;
            display: none;
        }

        .hidden {
            display: none;
        }

        .loading {
            text-align: center;
            display: none;
            font-weight: bold;
            margin-top: 20px;
            color: #555;
        }

        #paymentMethodIcons {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        #paymentMethodIcons img {
            max-width: 100px;
            padding: 15px;
            height: auto;
        }
    </style>
</head>
<body>
   
    <div id="paymentForm">
        <form onsubmit="submitPayment(event)">
            <label for="paymentMethod">Select Payment Method:</label>
            <select id="paymentMethod" onchange="togglePaymentMethod()">
                <option value="none" selected disabled>Select a method</option>
                <option value="upi">UPI Payment</option>
                <option value="creditCard">Credit Card</option>
                <option value="netBanking">Net Banking</option>
            </select>

            <div id="paymentMethodIcons">
                <img id="mobikwikIcon" src="images/mobikwik.jpg" alt="Mobikwik">
                <img id="paytmIcon" src="images/paytm.jpg" alt="Paytm">
                <img id="phonePeIcon" src="images/phonepe.jpg" alt="PhonePe">
            </div>
            <br><br>
            <div id="upi" class="hidden">
                <label for="upiId">Enter UPI ID:</label>
                <input type="text" id="upiId" placeholder="UPI ID">
                <span id="upiIdError" class="error"></span>
            </div>

            <div id="creditCard" class="hidden">
                <label for="cardNumber">Enter Card Number:</label>
                <input type="text" id="cardNumber" placeholder="Card Number">

                <label for="expiry">Expiry Date:</label>
                <input type="text" id="expiry" placeholder="MM/YY">

                <label for="cvv">CVV:</label>
                <input type="text" id="cvv" placeholder="CVV">
                <span id="cvvError" class="error"></span>
            </div>

            <div id="netBanking" class="hidden">
                <label for="bankName">Select Bank:</label>
                <input type="text" id="bankName" placeholder="Bank Name">
                <span id="bankNameError" class="error"></span>
            </div>

            <button type="submit">Pay Now</button>

            <div id="loading" class="loading">
                Loading...
            </div>
        </form>
    </div>

    <script>
        function togglePaymentMethod() {
            paymentMethod = document.getElementById('paymentMethod').value;
            paymentDivs = document.querySelectorAll('#upi, #creditCard, #netBanking');

            paymentDivs.forEach(div => {
                if (div.id === paymentMethod) {
                    div.classList.remove('hidden');
                } else {
                    div.classList.add('hidden');
                }
            });
        }

        function validateForm() {
            const paymentMethod = document.getElementById('paymentMethod').value;

            if (paymentMethod === 'none') {
                alert('Please select a payment method.');
                return false;
            }

            if (paymentMethod === 'upi') {
                upiId = document.getElementById('upiId').value.trim();
                if (upiId === '') {
                    document.getElementById('upiIdError').textContent = 'Please enter UPI ID';
                    document.getElementById('upiIdError').style.display = 'block';
                    return false;
                } else {
                    document.getElementById('upiIdError').style.display = 'none';
                }
            } else if (paymentMethod === 'creditCard') {
                cvv = document.getElementById('cvv').value.trim();
                if (cvv === '' || isNaN(cvv) || cvv.length !== 3) {
                    document.getElementById('cvvError').textContent = 'Invalid CVV';
                    document.getElementById('cvvError').style.display = 'block';
                    return false;
                } else {
                    document.getElementById('cvvError').style.display = 'none';
                }
            } else if (paymentMethod === 'netBanking') {
                bankName = document.getElementById('bankName').value.trim();
                if (bankName === '') {
                    document.getElementById('bankNameError').textContent = 'Please enter Bank Name';
                    document.getElementById('bankNameError').style.display = 'block';
                    return false;
                } else {
                    document.getElementById('bankNameError').style.display = 'none';
                }
            }

            return true;
        }

        function submitPayment(event) {
            event.preventDefault();

            if (validateForm()) {
                document.getElementById('paymentForm').style.display = 'none';
                document.getElementById('loading').style.display = 'block';

                setTimeout(function () {
                    document.getElementById('loading').style.display = 'none';
                    alert('Thank you! Your payment was successful.');

                    setTimeout(function () {
                        window.location.href = "index.php";
                    }, 1000);
                }, 2000);
            }
        }
    </script>
</body>
</html>