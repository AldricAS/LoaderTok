<?php
require_once "DownloadClass.php";

$result = null;
$error  = null;

if (isset($_POST['url'])) {
    $url = trim($_POST['url']);

    if (!empty($url)) {
        $tiktok = new DownloadClass();
        $data   = $tiktok->Data($url);

        if ($data['err'] === "false") {
            $result = $data;
        } else {
            $error = $data['message'] ?? "Gagal mengambil data video";
        }
    } else {
        $error = "URL tidak boleh kosong";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>TikTok Downloader No WM</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
body{
    font-family:system-ui,Arial;
    background:#0b0f14;
    color:#e5e7eb;
    display:flex;
    justify-content:center;
    min-height:100vh;
}
.box{
    width:100%;
    max-width:500px;
    margin-top:60px;
    background:#121722;
    padding:20px;
    border-radius:14px;
}
input,button{
    width:100%;
    padding:12px;
    margin-top:10px;
    border-radius:10px;
    border:none;
    font-size:14px;
}
input{
    background:#0b0f14;
    color:#fff;
}
button{
    background:#22c55e;
    color:#000;
    font-weight:600;
    cursor:pointer;
}
.result{
    margin-top:20px;
}
.error{
    margin-top:15px;
    color:#f87171;
}
img{
    width:80px;
    border-radius:50%;
}
a.download{
    display:block;
    margin-top:10px;
    background:#3b82f6;
    color:#fff;
    text-align:center;
    padding:10px;
    border-radius:10px;
    text-decoration:none;
}
</style>
</head>
<body>

<div class="box">
    <h2>TikTok Downloader</h2>

    <form method="post">
        <input type="url" name="url" placeholder="Paste link TikTok..." required>
        <button type="submit">Download</button>
    </form>

    <?php if ($error): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <?php if ($result): ?>
        <div class="result">
            <img src="<?= $result['imageUrl'] ?>">
            <p><b><?= htmlspecialchars($result['nickname']) ?></b></p>
            <p><?= htmlspecialchars($result['title']) ?></p>

            <a class="download"
               href="download.php?url=<?= urlencode($result['playAddr']) ?>&name=<?= urlencode($result['filename']) ?>">
               Download Video (No WM)
            </a>
        </div>
    <?php endif; ?>
</div>

</body>
</html>
  
