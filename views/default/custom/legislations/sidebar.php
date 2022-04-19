<?php   


$twig = elgg_legislation_twig();
$site_url = elgg_get_site_url();
$data['site_url'] = $site_url;

echo $twig->render('legislation/layouts/alt-sidebar.html.twig', 
    [
        'data' => $data,
    ]);