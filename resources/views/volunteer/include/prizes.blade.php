
            <li class="nav-item">
                <a class="nav-link collapsed" href="#prizes" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="prizes">
                  <i class="fas fa-award text-primary"></i>
                  <span class="nav-link-text">Nagrody</span>
                </a>
                <div class="collapse" id="prizes">
                  <ul class="nav nav-sm flex-column">
                    <li class="nav-item">
                      <a href="{{ route('v.prize.list') }}" class="nav-link">
                        <span class="sidenav-normal"> Lista </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{ route('v.prize.orders') }}" class="nav-link">
                        <span class="sidenav-normal"> Twoje zamówienia </span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
