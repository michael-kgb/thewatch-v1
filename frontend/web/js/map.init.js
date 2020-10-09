$(document).ready(function () {
    $.ajax({
        type: "POST",
        url:  "store/getalllocation",
        data: {},
        dataType: "json",
        success: function (data) {
            if ($(".mapcontainer").length) {
                $(".mapcontainer").mapael({
                    map: {
                        // Set the name of the map to display
                        name: "indonesia",
                        defaultArea: {
                            attrs: {
                                fill: "#707070",
                                'stroke-width': 0,
                            }
                            , attrsHover: {
                                fill: "#707070"
                            }
                            , text: {
                                attrs: {
                                    fill: "#505444"
                                }
                                , attrsHover: {
                                    fill: "#000"
                                }
                            }
                        },
                        legend: {
                            plot: [
                            ]
                        },
                        defaultPlot: {
                            size: 30,
                            eventHandlers: {
                                mouseover: function (e, id, mapElem, textElem, elemOptions) {
                                    if (typeof elemOptions.hoverText != 'undefined') {
                                        if (elemOptions.storeType == "retail") {
                                            $(mapElem.node).qtip({
                                                content: {
                                                    text: '<span class="gotham-medium">' + elemOptions.hoverText + '</span>'
                                                },
                                                position: {
                                                    my: 'bottom left',
                                                    adjust: {
                                                        y: -40
                                                    }
                                                },
                                                show: {ready: true}
                                            });

                                        } else {
                                            $(mapElem.node).qtip({
                                                content: {
                                                    text: '<span class="gotham-medium">' + elemOptions.hoverText + '</span>'
                                                },
                                                position: {
                                                    my: 'bottom left',
                                                    adjust: {
                                                        y: -40
                                                    }
                                                },
                                                show: {ready: true}
                                            });
                                        }
                                    }
                                },
                                click: function (e, id, mapElem, textElem, elemOptions) {
                                    console.log(id);
                                    goto(id);
                                }
                            }
                        }
                    },
                    legend: {
                        plot: {
                            title: " ",
                            mode: 'horizontal',
                            labelAttrs: {
                                "font-size": 12,
                            },
                            marginLeft: 5,
                            marginLeftLabel: 5,
                            hideElemsOnClick: {
                                opacity: 0
                            },
                            slices: [
                                {
                                    label: "RETAIL STORES",
                                    type: "image",
                                    url:  baseUrl + '/img/icons/point.png',
                                    width: 15,
                                    height: 21,
                                    min: "1",
                                    marginLeftLabel: 100,
                                    max: "2"

                                }
                            ]
                        }
                    },
                    plots: data,
                });
            }
        }
    });
});