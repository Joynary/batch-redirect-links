<?php
function guide_fetch_site_info($url) {
    $domain = parse_url($url, PHP_URL_HOST);
    // 提取域名并格式化：去掉www.前缀，去掉后缀，首字母大写
    $cleanDomain = preg_replace('/^www\./i', '', $domain);
    $parts = explode('.', $cleanDomain);
    $mainDomain = $parts[0];
    $name = ucfirst(strtolower($mainDomain));
    
    $logo = "https://www.google.com/s2/favicons?sz=64&domain=$domain";
    $desc = '';
    $html = @file_get_contents($url);
    if ($html) {
        if (preg_match('/<meta name="description" content="([^"]*)"/i', $html, $matches)) {
            $desc = $matches[1];
        }
    }
    return [
        'name' => $name,
        'logo' => $logo,
        'desc' => $desc,
        'domain' => $domain,
    ];
}