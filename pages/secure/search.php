<?php
require_once 'functions.php';
require_once __DIR__ . '/../../infra/repositories/contentRepository.php';

$user = user();
$title = '- App';

renderHeader($title);
renderNavbar($user);
?>

<style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap");

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
        color: white;
    }

    body {
        background-color: #f8f9fa; /* Add your preferred background color */
    }

    main {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
    }

    form {
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(30px);
        background: transparent;
        text-align: center;
        max-width: 800px;
        width: 100%;
    }

    .search-bar-size {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .form-control {
        border: none;
        border-radius: 20px;
        padding: 12px;
        font-size: 16px;
        color: #495057;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    .btn-default {
        background-color: #e3c624; /* Your button color */
        border: none;
        border-radius: 20px;
        padding: 12px 20px;
        cursor: pointer;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        transition: background-color 0.3s;
    }

    .btn-default:hover {
        background-color: #e3c624; /* Your button hover color */
    }
</style>

<main class="container">
    <div class="d-flex mt-5 py-5 justify-content-center">
        <form action="/SIR-TP1/controllers/content/content.php" method="get" onsubmit="return validateSearchForm()" class="search-bar-size">
            <h2 style="margin-bottom: 20px; color: white;">What are you searching for?</h2>
            <div class="input-group w-100">
                <input type="text" name="searchInput" class="form-control" placeholder="Search for shows..." maxlength="255">
            </div>
            <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
            <button type="submit" name="submitSearch" class="btn btn-default">
                Search
            </button>
        </form>
    </div>
</main>

<script>
    function validateSearchForm() {
        var searchInput = document.getElementById('searchInput').value;

        if (searchInput.trim() === '') {
            alert('Please enter a search term');
            return false;
        }

        return true;
    }
</script>

<?php
renderFooter();
?>
