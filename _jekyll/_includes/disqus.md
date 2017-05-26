{% if page.comments %}
<div id="disqus_thread"></div>
<script>

var disqus_identifier = '{% if page.disqus_identifier %}{{ page.disqus_identifier}}{% else %}{{ site.url }}{{ page.url }}{% endif %}';
var disqus_url = '{{ site.url }}{{ page.url }}';

var disqus_config = function () {
  this.page.url = disqus_url;  // Replace PAGE_URL with your page's canonical URL variable
  this.page.identifier = disqus_identifier; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
};

(function() { // DON'T EDIT BELOW THIS LINE
var d = document, s = d.createElement('script');
s.src = 'https://tjbiddle.disqus.com/embed.js';
s.setAttribute('data-timestamp', +new Date());
(d.head || d.body).appendChild(s);
})();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>

{% endif %}
