if (!window.WTVVIN) {
    window.WTVVIN = {
        sApiUrl: '',
        iDvsId: 0,
        init: function (params) {
            this.sApiUrl = params.apiUrl;
            this.iDvsId = params.dvs;

            var cchead = document.getElementsByTagName("head");
            var cclink = document.createElement('link');
            cclink.href = params.styleUrl;
            cclink.type = 'text/css';
            cclink.charset = 'utf-8';
            cclink.rel = 'stylesheet';
            cchead[0].appendChild(cclink);

            var sAllVin = '';
            var x = this.GEBCN('dvs_vin_btn');
            for (i = 0; i < x.length; i++) {
                sVinId = x[i].getAttribute('vin');
                sAllVin += sVinId + ',';

                x[i].setAttribute('id', 'dvs_vin_btn_' + sVinId);
                var sHTML = '<a style="display: none;" href="#">' + x[i].getAttribute('title') + '</a><div class="dvs_vin_loading"></div>';
                x[i].innerHTML = sHTML;
            }
            if(sAllVin.length > 0) {
                sAllVin = sAllVin.substring(0, sAllVin.length - 1);
            }

            var ccscript = document.createElement('script');
            ccscript.src = params.scriptUrl + 'vin_' + sAllVin + '/';
            ccscript.type = 'text/javascript';
            cchead[0].appendChild(ccscript);
        },

        GEBCN: function(cn){
            if(document.getElementsByClassName) // Returns NodeList here
                return document.getElementsByClassName(cn);

            cn = cn.replace(/ *$/, '');

            if(document.querySelectorAll) // Returns NodeList here
                return document.querySelectorAll((' ' + cn).replace(/ +/g, '.'));

            cn = cn.replace(/^ */, '');

            var classes = cn.split(/ +/), clength = classes.length;
            var els = document.getElementsByTagName('*'), elength = els.length;
            var results = [];
            var i, j, match;

            for(i = 0; i < elength; i++){
                match = true;
                for(j = clength; j--;)
                    if(!RegExp(' ' + classes[j] + ' ').test(' ' + els[i].className + ' '))
                        match = false;
                if(match)
                    results.push(els[i]);
            }

            // Returns Array here
            return results;
        }
    }
}