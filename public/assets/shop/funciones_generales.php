<?php


function getLeftArrowIcon() {
  return "<svg xmlns='http://www.w3.org/2000/svg' width='22.51' height='20.443' viewBox='0 0 512 512'>
              <path fill='none' stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='48' d='M244 400L100 256l144-144M120 256h292' />
          </svg>
          <span class='visually-hidden'>page left arrow</span>";
}

function getRightArrowIcon() {
  return "<svg xmlns='http://www.w3.org/2000/svg' width='22.51' height='20.443' viewBox='0 0 512 512'>
              <path fill='none' stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='48' d='M268 112l144 144-144 144M392 256H100' />
          </svg>
          <span class='visually-hidden'>page right arrow</span>";
}

//generar paginación
function generatePagination($totalItems, $itemsPerPage, $currentPage, $range = 4) {
  $totalPages = ceil($totalItems / $itemsPerPage);
  $paginationHtml = "";

  // Flecha izquierda (anterior)
  if ($currentPage > 1) {
      $paginationHtml .= "<li class='pagination__list'>
                              <a href='?page=" . ($currentPage - 1) . "' class='pagination__item--arrow link'>
                                  " . getLeftArrowIcon() . "
                              </a>
                          </li>";
  }

  // Páginas numeradas con carrusel
  $start = max(1, $currentPage - floor($range / 2));
  $end = min($totalPages, $start + $range - 1);

  if ($start > 1) {
      $paginationHtml .= "<li class='pagination__list'><a href='?page=1' class='pagination__item link'>1</a></li>";
      if ($start > 2) {
          $paginationHtml .= "<li class='pagination__list'><span class='pagination__item pagination__item--dots'>...</span></li>";
      }
  }

  for ($i = $start; $i <= $end; $i++) {
      if ($i == $currentPage) {
          $paginationHtml .= "<li class='pagination__list'><span class='pagination__item pagination__item--current'>$i</span></li>";
      } else {
          $paginationHtml .= "<li class='pagination__list'><a href='?page=$i' class='pagination__item link'>$i</a></li>";
      }
  }

  if ($end < $totalPages) {
      if ($end < $totalPages - 1) {
          $paginationHtml .= "<li class='pagination__list'><span class='pagination__item pagination__item--dots'>...</span></li>";
      }
      $paginationHtml .= "<li class='pagination__list'><a href='?page=$totalPages' class='pagination__item link'>$totalPages</a></li>";
  }

  // Flecha derecha (siguiente)
  if ($currentPage < $totalPages) {
      $paginationHtml .= "<li class='pagination__list'>
                              <a href='?page=" . ($currentPage + 1) . "' class='pagination__item--arrow link'>
                                  " . getRightArrowIcon() . "
                              </a>
                          </li>";
  }

  return $paginationHtml;
}




