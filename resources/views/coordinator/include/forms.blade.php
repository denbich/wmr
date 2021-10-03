
            <li class="nav-item">
              <a class="nav-link collapsed" href="#forms" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="forms">
                <i class="fas fa-clipboard-list text-primary"></i>
                <span class="nav-link-text">Formularze</span>
              </a>
              <div class="collapse" id="forms">
                <ul class="nav nav-sm flex-column">
                  <li class="nav-item">
                    <a href="{{ route('c.form.list') }}" class="nav-link">
                      <span class="sidenav-normal"> Lista </span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('c.form.create') }}" class="nav-link">
                      <span class="sidenav-normal"> Utwórz nowy </span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
