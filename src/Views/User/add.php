<div class="main-content">
    <form action="#" method="post">
        <fieldset>
            <label for="name">Username</label>
            <input type="text" name="name" id="name">
            <label for="pwd">Password</label>
            <input type="password" name="pwd" id="pwd">
            <label for="confirm_pwd">Confirm Password</label>
            <input type="password" name="confirm_pwd" id="confirm_pwd">
        </fieldset>
        <button type="submit" name="submit">Register</button>
    </form>
</div>
<?php
if (isset($formData)) {
    echo '<pre>';
    var_dump($formData);
    echo '</pre>';
}
?>