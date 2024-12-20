import 'jquery';
import '../select.js';
//import 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js';

    

function formatState (state) {
    if (!state.id) {
      return state.text;
    }
    var baseUrl = elgg.normalize_url('/mod/legislation/graphics/sdg');
    var $state = $(
      '<span><img src="' + baseUrl + '/' + state.id + '.png" class="img-flag" width="40"/> ' + state.title + '</span>'
    );
    
    return $state;
  };

    $(document).ready(function() {
        $('.js-goals-single').select2({
            templateResult: formatState,
            templateSelection: formatState,
            width: '49%',
            placeholder: "Select a Sustainable Development Goal",
        });
    });
