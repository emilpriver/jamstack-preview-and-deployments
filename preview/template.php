<?php
$id = get_the_ID();
$postType = get_post_type($id);
$previewURL = getNextjsPreviewEndpointUrl();
$previewURLSecret = getNextjsPreviewEndpointSecret();
$url = str_replace(' ', '', "$previewURL?id=$id&secret=$previewURLSecret&postType=$postType");
?>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>NextJS Preview</title>
	<style>
		body {
			margin: 0;
			padding: 0;
			display: block;
		}
		.content {
			width: 100%;
			left: 0;
			top: 46px;
			height: 100vh;
			text-align: center;
			display: flex;
			justify-content: center;
			align-items: center;
			flex-direction: column;
			max-width: 80%;
			margin: 0 auto;
		}

		.content p {
			max-width: 800px;
			margin: 0 auto;
		}

		iframe {
			position: fixed;
			width: 100vw;
			left: 0;
			top: 46px;
			height: calc(100vh - 46px);
		}

		@media (min-width: 783px) {
			iframe {
				top: 32px;
				height: calc(100vh - 32px);
			}
		}
	</style>

	<script async>
        function showError() {
            document.addEventListener("DOMContentLoaded", function () {
                try {
                    const iframe = document.querySelector('#preview')
                    iframe.style.display = "none"
                } catch (e) {}

                try {
                    const content = document.querySelector('#content')
                    content.style.display = "flex"
                } catch (e) {}
            })
        }

        fetch("<?php echo $url; ?>", {mode: 'no-cors'})
            .catch(e => {
                showError()
            });
        </script>
    </head>

    <body>
    <?php if ($url): ?>
        <iframe
                id='preview'
                src="<?php echo $url; ?>"
                frameborder="0"
        ></iframe>
    <?php endif;?>

    <div id="content" class="error" style="display: none;">
        <h1>Preview broken</h1>
        <p>The Preview webhook set on the <a
                    href="<?php echo get_bloginfo('url'); ?>/wp-admin/options-general.php?page=nextjs-preview-options-page">settings
                page</a> isn't working properly.
            <br>
            Please ensure your URL is correct.
        </p>
    </div>
</body>
</html>
<?php wp_footer();?>