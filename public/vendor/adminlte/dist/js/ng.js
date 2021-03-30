setTimeout(function () {
    $('#alerta-time').fadeOut('fast');
}, 5000);

let scroll_dataTable;

if (window.matchMedia("(min-width:900px)").matches) 
{
    /* a view tem mais de 900 pixels de largura */
    scroll_dataTable = "600px";
} else 
{
    /* a viewport menos que 900 pixels de largura */
    scroll_dataTable = "230px";
}

$('#lista-itens').DataTable({
    "language": {
        "sEmptyTable": "Nenhum registro encontrado",
        "sInfo": "item _START_ até _END_ de _TOTAL_ itens",
        "sInfoEmpty": "item 0 até 0 de 0 itens",
        "sInfoFiltered": "(Total: _MAX_)",
        "sInfoPostFix": "",
        "sInfoThousands": ".",
        "sLengthMenu": "_MENU_ resultados por página",
        "sLoadingRecords": "Carregando...",
        "sProcessing": "Processando...",
        "sZeroRecords": "Nenhum registro encontrado",
        "sSearch": "Pesquisar",
        "oPaginate": {
            "sNext": "Próximo",
            "sPrevious": "Anterior",
            "sFirst": "Primeiro",
            "sLast": "Último"
        },
        "oAria": {
            "sSortAscending": ": Ordenar colunas de forma ascendente",
            "sSortDescending": ": Ordenar colunas de forma descendente"
        },
        "select": {
            "rows": {
                "_": "Selecionado %d linhas",
                "0": "Nenhuma linha selecionada",
                "1": "Selecionado 1 linha"
            }
        }
    },
    "order": [[6, 'asc'], [3, 'desc'], [4, 'desc']],
      "scrollX": true,
      "scrollY": scroll_dataTable,
      "scrollCollapse": true,

    responsive: true,


});

$('#lista-guild').DataTable({
    "language": {
        "sEmptyTable": "Nenhum registro encontrado",
        "sInfo": "item _START_ até _END_ de _TOTAL_ itens",
        "sInfoEmpty": "item 0 até 0 de 0 itens",
        "sInfoFiltered": "(Total: _MAX_)",
        "sInfoPostFix": "",
        "sInfoThousands": ".",
        "sLengthMenu": "_MENU_ resultados por página",
        "sLoadingRecords": "Carregando...",
        "sProcessing": "Processando...",
        "sZeroRecords": "Nenhum registro encontrado",
        "sSearch": "Pesquisar",
        "oPaginate": {
            "sNext": "Próximo",
            "sPrevious": "Anterior",
            "sFirst": "Primeiro",
            "sLast": "Último"
        },
        "oAria": {
            "sSortAscending": ": Ordenar colunas de forma ascendente",
            "sSortDescending": ": Ordenar colunas de forma descendente"
        },
        "select": {
            "rows": {
                "_": "Selecionado %d linhas",
                "0": "Nenhuma linha selecionada",
                "1": "Selecionado 1 linha"
            }
        }
    },
    "order": [[3, 'asc']],
      "scrollX": true,
      "scrollY": scroll_dataTable,
      "scrollCollapse": true,

    responsive: true,


});

$('#example').DataTable();

$('#lista-news').DataTable({
    "language": {
        "sEmptyTable": "Nenhum registro encontrado",
        "sInfo": "item _START_ até _END_ de _TOTAL_ itens",
        "sInfoEmpty": "item 0 até 0 de 0 itens",
        "sInfoFiltered": "(Total: _MAX_)",
        "sInfoPostFix": "",
        "sInfoThousands": ".",
        "sLengthMenu": "_MENU_ resultados por página",
        "sLoadingRecords": "Carregando...",
        "sProcessing": "Processando...",
        "sZeroRecords": "Nenhum registro encontrado",
        "sSearch": "Pesquisar",
        "oPaginate": {
            "sNext": "Próximo",
            "sPrevious": "Anterior",
            "sFirst": "Primeiro",
            "sLast": "Último"
        },
        "oAria": {
            "sSortAscending": ": Ordenar colunas de forma ascendente",
            "sSortDescending": ": Ordenar colunas de forma descendente"
        },
        "select": {
            "rows": {
                "_": "Selecionado %d linhas",
                "0": "Nenhuma linha selecionada",
                "1": "Selecionado 1 linha"
            }
        }
    },
    "order": [[0, 'desc'], [5, 'desc']],
      "scrollX": true,
      "scrollY": scroll_dataTable,
      "scrollCollapse": true,

    responsive: true,


});

$('#lista-sale').DataTable({
    columnDefs: [
        {
            targets: 1,
            className: 'dt-head-center dt-body-left'
        }
      ],
    
    "language": {
        "sEmptyTable": "Nenhum registro encontrado",
        "sInfo": "item _START_ até _END_ de _TOTAL_ itens",
        "sInfoEmpty": "item 0 até 0 de 0 itens",
        "sInfoFiltered": "(Total: _MAX_)",
        "sInfoPostFix": "",
        "sInfoThousands": ".",
        "sLengthMenu": "_MENU_ resultados por página",
        "sLoadingRecords": "Carregando...",
        "sProcessing": "Processando...",
        "sZeroRecords": "Nenhum registro encontrado",
        "sSearch": "Pesquisar",
        "oPaginate": {
            "sNext": "Próximo",
            "sPrevious": "Anterior",
            "sFirst": "Primeiro",
            "sLast": "Último"
        },
        "oAria": {
            "sSortAscending": ": Ordenar colunas de forma ascendente",
            "sSortDescending": ": Ordenar colunas de forma descendente"
        },
        "select": {
            "rows": {
                "_": "Selecionado %d linhas",
                "0": "Nenhuma linha selecionada",
                "1": "Selecionado 1 linha"
            }
        }
    },
    "order": [[4, 'asc'], [2, 'desc']],
    "scrollX": true,
    "scrollY": scroll_dataTable,
    "scrollCollapse": true,

   //responsive: true,
   


});


$('#bau-itens').DataTable({
 
        "language": {
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "item _START_ até _END_ de _TOTAL_ itens",
            "sInfoEmpty": "item 0 até 0 de 0 itens",
            "sInfoFiltered": "(Total: _MAX_)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "_MENU_ resultados por página",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "Pesquisar",
            "oPaginate": {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            },
            "oAria": {
                "sSortAscending": ": Ordenar colunas de forma ascendente",
                "sSortDescending": ": Ordenar colunas de forma descendente"
            },
            "select": {
                "rows": {
                    "_": "Selecionado %d linhas",
                    "0": "Nenhuma linha selecionada",
                    "1": "Selecionado 1 linha"
                }
            },
            
        },
        "order": [[2, 'asc'], [1, 'asc']],
          "scrollX": true,
          "scrollY": scroll_dataTable,
          "scrollCollapse": true,

          responsive: true,

        
       
     


});


   

$(function () {
 //inicio carregar popover
 //$('.popover-avatar').webuiPopover();
 $('.popover-avatar').webuiPopover({style: 'inverse'});

 //fim carregar popover

 
});

function loadSection(section){
    $("#conteudo").load(section);
}

/* counter js */

(function ($) {
$.fn.countTo = function (options) {
    options = options || {};
    
    return $(this).each(function () {
        // set options for current element
        var settings = $.extend({}, $.fn.countTo.defaults, {
            from:            $(this).data('from'),
            to:              $(this).data('to'),
            speed:           $(this).data('speed'),
            refreshInterval: $(this).data('refresh-interval'),
            decimals:        $(this).data('decimals')
        }, options);
        
        // how many times to update the value, and how much to increment the value on each update
        var loops = Math.ceil(settings.speed / settings.refreshInterval),
            increment = (settings.to - settings.from) / loops;
        
        // references & variables that will change with each update
        var self = this,
            $self = $(this),
            loopCount = 0,
            value = settings.from,
            data = $self.data('countTo') || {};
        
        $self.data('countTo', data);
        
        // if an existing interval can be found, clear it first
        if (data.interval) {
            clearInterval(data.interval);
        }
        data.interval = setInterval(updateTimer, settings.refreshInterval);
        
        // initialize the element with the starting value
        render(value);
        
        function updateTimer() {
            value += increment;
            loopCount++;
            
            render(value);
            
            if (typeof(settings.onUpdate) == 'function') {
                settings.onUpdate.call(self, value);
            }
            
            if (loopCount >= loops) {
                // remove the interval
                $self.removeData('countTo');
                clearInterval(data.interval);
                value = settings.to;
                
                if (typeof(settings.onComplete) == 'function') {
                    settings.onComplete.call(self, value);
                }
            }
        }
        
        function render(value) {
            var formattedValue = settings.formatter.call(self, value, settings);
            $self.html(formattedValue);
        }
    });
};

$.fn.countTo.defaults = {
    from: 0,               // the number the element should start at
    to: 0,                 // the number the element should end at
    speed: 1000,           // how long it should take to count between the target numbers
    refreshInterval: 100,  // how often the element should be updated
    decimals: 0,           // the number of decimal places to show
    formatter: formatter,  // handler for formatting the value before rendering
    onUpdate: null,        // callback method for every time the element is updated
    onComplete: null       // callback method for when the element finishes updating
};

function formatter(value, settings) {
    return value.toFixed(settings.decimals);
}
}(jQuery));

jQuery(function ($) {
// custom formatting example
$('.count-number').data('countToOptions', {
formatter: function (value, options) {
return value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',');
}
});

// start all the timers
$('.timer').each(count);  

function count(options) {
var $this = $(this);
options = $.extend({}, options || {}, $this.data('countToOptions') || {});
$this.countTo(options);
}
});

