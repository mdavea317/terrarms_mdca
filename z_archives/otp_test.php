<form id="send-code-form" method="POST" action="send_verification.php">
    <input type="text" name="phone_number" placeholder="Enter your phone number" required />
    <button type="submit">Send Verification Code</button>
</form>

<form id="verify-code-form" method="POST" action="verify_code.php" style="display: none;">
    <input type="text" name="phone_number" placeholder="Enter your phone number" required />
    <input type="text" name="verification_code" placeholder="Enter the verification code" required />
    <button type="submit">Verify Code</button>
</form>

<script>
    const sendCodeForm = document.getElementById('send-code-form');
    const verifyCodeForm = document.getElementById('verify-code-form');

    sendCodeForm.onsubmit = async function (event) {
        event.preventDefault();
        const formData = new FormData(sendCodeForm);
        const response = await fetch('send_verification.php', {
            method: 'POST',
            body: formData
        });
        const result = await response.json();
        if (result.success) {
            alert('Code sent!');
            sendCodeForm.style.display = 'none';
            verifyCodeForm.style.display = 'block';
        } else {
            alert('Error: ' + result.error);
        }
    };

    verifyCodeForm.onsubmit = async function (event) {
        event.preventDefault();
        const formData = new FormData(verifyCodeForm);
        const response = await fetch('verify_code.php', {
            method: 'POST',
            body: formData
        });
        const result = await response.json();
        if (result.success) {
            alert('Verification successful!');
        } else {
            alert('Error: ' + result.error);
        }
    };
</script>
