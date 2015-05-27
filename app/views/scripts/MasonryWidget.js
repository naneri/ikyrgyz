'use strict';
var S,
MasonryWidget = {

    options :     {
        '1' : {
            columnWidth : 650,
            masonryClass: 'b-user-wall-1000'
        },
        '2' : {
            columnWidth : 495,
            masonryClass: 'b-user-wall-495'
        },
        '3' : {
            columnWidth : 325,
            masonryClass: 'b-user-wall-325'
        }
    },

    settings :  {
        parentEl    : $('.masonry'),
        childEl     : $('.b-user-wall')
    },

    init: function(){
        S = this.settings;
        this.getNewStuff();
    }
};