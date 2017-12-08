// Generos
const GENERO = new Bloodhound({
    local: [
    {value: "Acción"},
    {value: "Ciencia ficción"},
    {value: "Adolescente"},
    {value: "Animación"},
    {value: "Aventuras"},
    {value: "Cine negro"},
    {value: "Comica (Humor)"},
    {value: "Documental"},
    {value: "Dramática"},
    {value: "Erótica"},
    {value: "Fantástica"},
    {value: "Gore"},
    {value: "Bélica"},
    {value: "Histórica"},
    {value: "Infantil"},
    {value: "Misterio"},
    {value: "Musical"},
    {value: "Propaganda"},
    {value: "Adolescente"},
    {value: "Policiaca"},
    {value: "Pornográfica"},
    {value: "Romántica"},
    {value: "Terror"},
    {value: "Westerm"}
],
    datumTokenizer: function(d) {
        return Bloodhound.tokenizers.whitespace(d.value);
    },
    queryTokenizer: Bloodhound.tokenizers.whitespace
});

GENERO.initialize();

$('#category').tokenfield({
    typeahead: [null, {
        source: GENERO.ttAdapter(),
        displayKey: 'value' }]
});
