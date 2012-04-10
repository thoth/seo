var _gaq = _gaq || [];
  
_gaq.push(['_setAccount', '{{google_analytics_ua}}']);

_gaq.push(['_setDomainName', '{{google_analytics_domain}}']);
_gaq.push(['_addIgnoredRef', '{{google_analytics_domain}}']);

_gaq.push(['_setCampSourceKey', 'utm_source']);
_gaq.push(['_setCampMediumKey', 'utm_medium']);
_gaq.push(['_setCampContentKey', 'utm_keyword']);
_gaq.push(['_setCampTermKey', 'utm_keyword']);
_gaq.push(['_setCampNameKey', 'utm_campaign']);
_gaq.push(['_trackPageview']);

(function() {
var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();