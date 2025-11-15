<footer class="footer py-4">
  <div class="container-fluid">
    <div class="d-block mx-auto">
      {!! !is_null($footerTextInfo) ? replaceBaseUrl($footerTextInfo->copyright_text, 'summernote') : '' !!}
    </div>
  </div>
</footer>
