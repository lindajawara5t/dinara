<?php
/**
 * TEST AJAX FORM SUBMISSION
 * Simulating HTML form submission via AJAX
 */

?>
<!DOCTYPE html>
<html>
<head>
    <title>Test Form Submission</title>
</head>
<body>
    <h1>Test Update Settings Form</h1>
    
    <form id="testForm">
        <div>
            <label>Judul Besar:</label>
            <input type="text" name="hero_title" value="TEST JUDUL - <?= time() ?>">
        </div>
        <div>
            <label>Announcement:</label>
            <textarea name="announcement">TEST ANNOUNCEMENT</textarea>
        </div>
        <button type="button" onclick="submitForm()">Submit via AJAX</button>
        <button type="submit" onclick="submitFormNormal(event)">Submit Normal</button>
    </form>
    
    <div id="result"></div>
    
    <script>
        function submitForm() {
            const formData = new FormData(document.getElementById('testForm'));
            
            fetch('<?= base_url('admin/update_settings') ?>', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                document.getElementById('result').innerHTML = 'Status: ' + response.status + '<br>' + response.statusText;
                return response.text();
            })
            .then(text => {
                document.getElementById('result').innerHTML += '<br>Response: ' + text.substring(0, 200);
            })
            .catch(err => {
                document.getElementById('result').innerHTML = 'Error: ' + err.message;
            });
        }
        
        function submitFormNormal(e) {
            e.preventDefault();
            document.getElementById('testForm').action = '<?= base_url('admin/update_settings') ?>';
            document.getElementById('testForm').method = 'POST';
            document.getElementById('testForm').submit();
        }
        
        function base_url(path) {
            return '/dinara/' + path;
        }
    </script>
</body>
</html>
