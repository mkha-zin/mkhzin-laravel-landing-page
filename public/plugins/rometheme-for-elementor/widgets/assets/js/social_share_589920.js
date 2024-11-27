jQuery(document).ready(($) => {
    $('.rkit-social-share__link').click((event) => {
        var SocMed = $(event.currentTarget).data('social-media');
        switch (SocMed) {
            case 'facebook':
                var url = encodeURIComponent(window.location.href);
                var title = encodeURIComponent(document.title);
                window.open('../../../../../../https/wwwfacebookcom/login_php_7798886.html' + url + '&title=' + title, 'facebook-share-dialog', 'width=626,height=436');
                break;
            case 'twitter':
                var url = encodeURIComponent(window.location.href);
                var text = encodeURIComponent(document.title);
                window.open('../../../../../../https/xcom/intent/tweet_4259893.html' + url + '&text=' + text, 'twitter-share-dialog', 'width=626,height=436');
                break;
            case 'whatsapp':
                var text = encodeURIComponent(window.location.href);
                window.open('../../../../../../https/apiwhatsappcom/send_4325438.html' + text, 'wa-share-dialog', ' width=626,height=626 ');
                break;
            case 'pinterest':
                var url = encodeURIComponent(window.location.href);
                var media = (document.querySelector('meta[property="og:image"]')) ? encodeURIComponent(document.querySelector('meta[property="og:image"]').getAttribute('content')) : '';
                var description = (document.querySelector('meta[property="og:description"]')) ? encodeURIComponent(document.querySelector('meta[property="og:description"]').getAttribute('content')) : '';
                window.open('../../../../../../https/wwwpinterestcom/pin/create/button/index_7864389.html' + url + '&media=' + media + '&description=' + description, 'pinterest-share-dialog', 'width=750,height=430');
                break;
            case 'linkedin':
                var url = encodeURIComponent(window.location.href);
                var title = encodeURIComponent(document.title);
                window.open('../../../../../../https/wwwlinkedincom/uas/login_4653159.html' + url + '&title=' + title, 'linkedin-share-dialog', 'width=750,height=430');
                break;
            case 'reddit':
                var url = encodeURIComponent(window.location.href);
                var title = encodeURIComponent(document.title);
                window.open('../../../../../../https/wwwredditcom/login/index_5439514.html' + url + '&title=' + title, 'reddit-share-dialog', 'width=500,height=500');
                break;
            case 'quora':
                var url = encodeURIComponent(window.location.href);
                var title = encodeURIComponent(document.title);
                window.open('../../../../../../https/wwwquoracom/link/Share_5242955_5374049.html' + url + '&title=' + title, 'quora-share-dialog', 'width=626,height=436');
                break;
            case 'telegram':
                var url = encodeURIComponent(window.location.href);
                window.open('../../../../../../https/telegramorg/index_2686978.html' + url, 'telegram-share-dialog', 'width=626,height=626');
                break;
            case 'line':
                var url = encodeURIComponent(window.location.href);
                window.open('../../../../../../https/accesslineme/oauth2/v21/login_1507433.html' + url, 'line-share-dialog', 'width=626 , height=626');
                break;
        }
    });
});