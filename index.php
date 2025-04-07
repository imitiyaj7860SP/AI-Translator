<?php
require_once 'src/Translator.php';
require_once 'src/TranslationAPI.php';
require_once 'src/Language.php';

// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

$translator = new Translator();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $text = $_POST['text'] ?? '';
    $fromLanguage = $_POST['fromLanguage'] ?? 'en';
    $toLanguage = $_POST['toLanguage'] ?? 'es';

    // Perform translation
    $translation = $translator->translate($text, $fromLanguage, $toLanguage);
    
    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode(['translation' => $translation]);
    exit;
}

// Languages for dropdown
$languages = [
    'en' => 'English',
    'es' => 'Spanish',
    'fr' => 'French',
    'de' => 'German',
    'it' => 'Italian',
    'pt' => 'Portuguese',
    'ru' => 'Russian',
    'zh' => 'Chinese',
    'ja' => 'Japanese',
    'ko' => 'Korean',
    'ar' => 'Arabic',
    'hi' => 'Hindi'
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">
    <title>PHP Translator App</title>
</head>
<body>
    <h1>PHP Translator App</h1>
    <form id="translator-form">
        <textarea name="text" placeholder="Enter text to translate" required></textarea>
        
        <div class="language-selectors">
            <div class="language-select">
                <label for="fromLanguage">From:</label>
                <select name="fromLanguage" id="fromLanguage">
                    <?php foreach ($languages as $code => $name): ?>
                        <option value="<?php echo $code; ?>"><?php echo $name; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="language-select">
                <label for="toLanguage">To:</label>
                <select name="toLanguage" id="toLanguage">
                    <?php foreach ($languages as $code => $name): ?>
                        <?php if ($code != 'en'): ?>
                            <option value="<?php echo $code; ?>" <?php echo ($code == 'es') ? 'selected' : ''; ?>><?php echo $name; ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        
        <button type="submit">Translate</button>
    </form>
    <div id="translation-result"></div>
    <script src="public/js/script.js"></script>
</body>
</html>