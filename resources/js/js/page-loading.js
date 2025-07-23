(function () {
    window.onload = function () {
        const preloader = document.querySelector('.page-loading');
        if (preloader) {
            preloader.classList.remove('active');
            setTimeout(function () {
                preloader.remove();
            }, 1000);
        }
    };

    function setupRewardfulIntegration()
    {
        setTimeout(function() {
            const referralId = Rewardful.referral;
            console.log(referralId);
            localStorage.setItem('kr-referral-id', referralId);
            const field = document.getElementById('referral_id');
            if (field) field.value = referralId;
        }, 2000);
    }

    setupRewardfulIntegration();
})();
