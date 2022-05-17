<?php
$root_directory = __DIR__;

$ignore_directories = [
    '.', '..', '.well-known', 'assets', 'php'
];

$project_directories = scandir($root_directory, SCANDIR_SORT_DESCENDING);

$projects = [];

foreach($project_directories as &$value){
    if(in_array($value, $ignore_directories) || !is_dir($root_directory.'/'.$value)) continue;

    $project_properties = @json_decode(@file_get_contents(
        $root_directory.'/'.$value.'/'.'composer.json'
    ));

    if(!empty($project_properties)){
        $project_properties->name = explode('/', $project_properties->name);
        $project_properties->name = $project_properties->name[
            (count($project_properties->name) > 1 ?
            1 : 0
        )];

        $project_properties->name = str_replace('_', ' ', $project_properties->name);

        $project_properties->url = '/'.$value.'/';

        array_push($projects, $project_properties);
    }
}

//echo json_encode($projects, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

?>
<!doctype html>
<!--


    ____    __ ___    _ _     __ _ _ __  _ __  ___
   |  _  \ / _` | \  / / |   / _` |  _ \|  _ \/ __|
   | |_ ) | (_| |\ \/ /| |  | (_| | |_) | |_) \__ \
   |____ / \__,_| \__/ |_|   \__,_|  __/|  __/|___/
         copyright 2020     v1.0  |_|   |_|  beta

Created by daviinacio on 01/02/2020

-->
<?php require __DIR__.'/../libs/minifier.php'; ?>

<html ng-app="myApp" lang="br">
<head>
	<base href="/">
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta http-equiv="Content-Script-Type" content="text/javascript" />

    <meta name="author" content="Davi Inácio" />
    <meta name="theme-color" content="#1d1d1d" />

	<title>Prototype - DaviApps</title>
    <meta name="description" content="Some prototype of page design" />
	
    <!-- Fonts -->
    <link rel="stylesheet" href="/assets/bootstrap-grid.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,400,600,800" rel="stylesheet">
    <style>
        :root {
            --background: #1d1d1d;
            --foreground: #eee;
            --foreground2: #aaa;
            --colorPrimary: #349ace;
            --colorPrimaryDark: #105b82;
            --colorAccent: #00aaff;
        }

        html {
            overflow-x: hidden;
        }

        html, body {
            background: var(--background);
            color: var(--foreground);
            height: 100%;
        }
        html * {
            font-family: 'Nunito', sans-serif;
        }

        html, body, h1, h2, h3, h4, h5, h6, p, a, i, ul, ol, li {
            margin: 0;
            padding: 0;
        }

        main {
            min-height: 100%;
            padding: 10px;
        }

        section > article .row, section > article .row > * {
            margin-right: 0 !important;
            padding-right: 0;
        }

        section, section > article {
        }

        section > article {
            background: #404040;
            border-radius: 10px;
            margin-bottom: 10px;
            box-shadow: 0 0 10px black;
        }

        section {
            width: 100%;
            color: var(--foreground);
            text-decoration: none;
        }

        section > article > *:first-child {
            padding: 0;
        }

        section > article > *:first-child * {
            margin: 0;
            padding: 0;
            border: 0;
            width: 100%;
            height: 400px;
            
            pointer-events: none;

            margin-bottom: -6px;
            border-radius: 5px 0 0 5px;
        }

        section > article > div:last-child {
            padding-bottom: 5px;
        }

        section > article > div:last-child h2::first-letter {
            text-transform: uppercase;
        }

        section > article > div:last-child h2 {
            margin-top: 5px;
            width: 100%;
            font-size: 25px;

            white-space: nowrap;
            overflow: hidden;
            text-overflow: clip;
        }

        section > article > div:last-child p {
            font-size: 15px;
            margin: 5px 0;

            white-space: pre;           /* CSS 2.0 */
            white-space: pre-wrap;      /* CSS 2.1 */
            white-space: pre-line;      /* CSS 3.0 */
            white-space: -pre-wrap;     /* Opera 4-6 */
            white-space: -o-pre-wrap;   /* Opera 7 */
            white-space: -moz-pre-wrap; /* Mozilla */
            white-space: -hp-pre-wrap;  /* HP Printers */
            word-wrap: break-word;
            -moz-hyphens:auto; 
            -webkit-hyphens:auto; 
            -o-hyphens:auto; 
            hyphens:auto;
            text-align: justify;   
        }

        section > article > div:last-child a {
            text-decoration: none;
            color: var(--colorAccent);
            font-weight: 800;
        }

        hr {
            height: 1px;
            background: var(--colorPrimary);
            border: none;
            margin-bottom: 2px;
        }

        section.flex-center, div.flex-center, main.flex-center  {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        @media (max-width: 574px) {
				section > article > *:first-child * {
				border-radius: 5px 5px 0 0;
			}
        }
    </style>
</head>
<body>
    <main class="flex-center">
        <section class="container">
            <?php foreach($projects as &$project){ ?>
            <article class="row">
                <a class="col-12 col-sm-8 col-md-9 col-lg-10" href="<?=$project->url?>" target="_blank">
                    <iframe width="100%" src="<?=$project->url?>" scrolling="no"></iframe>
                </a>
                <div class="col-12 col-sm-4 col-md-3 col-lg-2">
                    <h2><?=$project->name?></h2>
                    <p><?=$project->description?></p>

                    <hr />
                    <span>Authors:
                        <?php foreach($project->authors as &$author){ ?>
                            <a href="mailto:<?=$author->email?>"><?=$author->name?></a>
                        <?php } ?>
                    </span>
                    <br />
                    <?=(isset($project->license) ? "
                        <span>License: $project->license</span>
                    " : "")?>
                </div>
            </article>
            <?php } ?>
        </section>
    </main>
</body>
</html>
