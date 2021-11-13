<footer class="py-5" id="footer-main">
    <div class="container">
      <div class="row align-items-center justify-content-xl-between">
        <div class="col-xl-6">
          <div class="copyright text-center text-xl-left text-muted">
            &copy; 2019 - {{ date('Y') }} <a href="https://linktr.ee/denis.bichler" class="font-weight-bold ml-1" target="_blank">Denis Bichler for MOSiR Rybnik</a>
          </div>
        </div>
        <div class="col-xl-6">
          <ul class="nav nav-footer justify-content-center justify-content-xl-end">
            <li class="nav-item">
                <a href="{{ url('/files/regulamin_wolontariatu_MOSiR_Rybnik.pdf') }}" class="nav-link" target="_blank">{{ __('index.footer.regulations') }}</a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/files/kodeks_wolontariuszy_MOSiR_Rybnik.pdf') }}" class="nav-link" target="_blank">{{ __('index.footer.codex') }}</a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/files/polityka_prywatnosci.pdf') }}" class="nav-link" target="_blank">{{ __('index.footer.privacypolicy') }}</a>
              </li>
          </ul>
        </div>
      </div>
    </div>
  </footer>
