<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Green Screen Actors</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <section class="video__section">
        <div class="video__container">
            <h1 class="video__heading">

            </h1>
            <div class="video__clip">

            </div>
            <div class="video__details">
                <div class="video__cta">
                    <div class="video__tags">
                        
                    </div>
                    <div class="video__btns">
                        <button type="button" class="video__btn-credit">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" />
                                </svg>
                                  
                                Use 1 Credit
                            </span>
                        </button>
                        <button type="button" class="video__btn-save">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                </svg>
                                Save
                            </span>
                        </button>
                    </div>
                </div>
                <div class="video__details">
                    <details open class="video__description">
                        <summary>Description</summary>
                        <div class="content"></div>
                    </details>
                    <details open class="video__category">
                        <summary>Category</summary>
                        <div class="content"></div>
                    </details>
                    <details open class="video__format">
                        <summary>Video Format</summary>
                        <div class="content"></div>
                    </details>
                    <details open class="video__frame-rate">
                        <summary>Frame Rate</summary>
                        <div class="content"></div>
                    </details>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script>
        fetch('https://greenscreenactors.com/api/video_details.php?account_id=0&clip_id=95', {
            method: 'GET', 
        })
            .then((response) => response.json())
            .then((data) => {
                const { response_body } = data
                const video = response_body[0]
                const { 
                    clip_title,
                    clip_public_filename,
                    clip_description,
                    clip_category,
                    frame_rates,
                    video_formats,
                    tags
                } = video

                console.log( video )
                
                render_heading( clip_title )
                render_video( clip_public_filename )
                render_tags( tags )
                render_description( clip_category, clip_description, video_formats, frame_rates )

            })
            .catch((error) => {
                console.error('Error:', error);
            });

        function render_heading(clip_title) {
            const title = clip_title.replaceAll('_', ' ')

            $('.video__heading').text( title )
            
        }

        function render_video(clip_public_filename) {
            const embed_url = "https://gsa.sfo3.digitaloceanspaces.com/watermarked_videos/" + clip_public_filename + '.mov';
            const embed_video = `<video class="video_show" data-url="${embed_url}" frameborder="0" controls="" height="400">
                    <source src="${embed_url}" type="video/mp4">
                </video>
            `
            $('.video__clip').html( embed_video )
        }

        function render_tags(tags) {
            const tagsHTML = tags.map(tag => {
                return `<span class="video__tag">${tag}</span>`
            })

            $('.video__tags').html(tagsHTML)
        }

        function render_description( clip_category, clip_description, video_formats, frame_rates ) {
            const video_formats_HTML = video_formats
                .map((vf) => { return `<li>${vf}</li>` })
                .join(' ')

            const frame_rates_HTML = frame_rates
                .map((fr) => { return `<li>${fr} FPS</li>` })
                .join(' ')

            $('.video__description .content').text( clip_category )
            $('.video__category .content').text( clip_description )
            $('.video__format .content').html( `<ul>${ video_formats_HTML }</ul>` )
            $('.video__frame-rate .content').html( `<ul>${ frame_rates_HTML }</ul>` )
        }
    </script>
</body>
</html>