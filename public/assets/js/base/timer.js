function Timer(options) 
{
    var that = this;
    
    var runID = 0;
    var runs = [];
    var previousRunDuration = 0;
    
    // this._startTime = 0;
    this._start = 0;
    this._end = 0;
    this._diff = 0;
    this._timerID = 0;

    // Timer settings
    var settings = Object.assign({
        // controls buttons
        btn_StartStop: "start-stop",
        btn_Reset: "reset",

        // Screen
        screen: "screen",

        // buttons text
        textStart: "Start",
        textStop: "Stop",
        textReset: "Reset Timer",

        // time separator
        separator: ":",

        autoStart: false,
        showHour: true,
        showMin: true,
        showSec: true,
        showMsec: true,

        refreshDelay: 1,

        resetOnStop: true,

        // actions
        onBeforeStart: null,
        onBeforeStop: null,
        onBeforeResume: null,
        onStart: null,
        onStop: null,
        onResume: null,
        onReset: null
    }, options);

    // Html Elements
    this._btns_startstop = document.querySelectorAll('[data-timer="'+ settings.btn_StartStop+'"]');
    this._btns_reset = document.querySelectorAll('[data-timer="'+ settings.btn_Reset+'"]');
    this._screens = document.querySelectorAll('[data-timer="'+ settings.screen +'"]');

    /**
     * 
     */
    this.timer = function() 
    {
        this._end = new Date();
        this._diff = this._end - this._start;
        this._diff = new Date(this._diff);

        var screen_text = '';

        // Hours
        if (settings.showHour) 
        {
            var hour = this._diff.getHours()-1;
                hour = pad(hour, 2);
            screen_text+= hour;
        }

        // Minutes
        if (settings.showMin) 
        {
            var min = this._diff.getMinutes();
                min = pad(min, 2);
            screen_text+= settings.separator + min;
        }

        // Secondes
        if (settings.showSec) 
        {
            var sec = this._diff.getSeconds();
                sec = pad(sec, 2);
                screen_text+= settings.separator + sec;
        }

        // MilliSeconds
        if (settings.showMsec) 
        {
            var msec = this._diff.getMilliseconds();
                msec = pad(msec, 3);
            screen_text+= settings.separator + msec;
        }

        // Show Time
        for (var i=0; i<this._screens.length; i++)
        {
            setElementText( this._screens[i], screen_text );
        }

        // Refresh
        this._timerID = setTimeout(function(){
            that.timer();
        }, settings.refreshDelay);
    }

    /**
     * Start the timer
     */
    this.start = function() 
    {

        if (typeof settings.onBeforeStart == 'function')
        {
            (settings.onBeforeStart)();
        }

        for (var i=0; i<this._btns_startstop.length ; i++)
        {
            setElementText( this._btns_startstop[i], settings.textStop );
            this._btns_startstop[i].onclick = function(){ that.stop(); };
            
            this._btns_startstop[i].classList.remove('stopped');            
            this._btns_startstop[i].className+= " started";
        }

        this._start = new Date();
        this.timer();

        if (typeof settings.onStart == 'function')
        {
            (settings.onStart)();
        }
        
        this.startRun();
    }

    /**
     * Stop the timer
     */
    this.stop = function() 
    {
        if (typeof settings.onBeforeStop == 'function')
        {
            (settings.onBeforeStop)();
        }

        for (var i=0; i<this._btns_startstop.length ; i++)
        {
            setElementText( this._btns_startstop[i], settings.textStart );

            if (settings.resetOnStop)
            {
                this._btns_startstop[i].onclick = function(){ that.start(); };
            }
            else
            {
                this._btns_startstop[i].onclick = function(){ that.resume(); };
            }

            this._btns_startstop[i].classList.remove('started');
            this._btns_startstop[i].className+= " stopped";
        }

        if (settings.resetOnStop)
        {
            this.reset();
        }
        
        clearTimeout(this._timerID);

        if (typeof settings.onStop == 'function')
        {
            (settings.onStop)();
        }

        this.stopRun();
    }

    /**
     * Resume the timer
     */
    this.resume = function() 
    {
        if (typeof settings.onBeforeResume == 'function')
        {
            (settings.onBeforeResume)();
        }

        for (var i=0; i<this._btns_startstop.length ; i++)
        {
            setElementText( this._btns_startstop[i], settings.textStop );
            this._btns_startstop[i].onclick = function(){ that.stop(); };
            
            this._btns_startstop[i].classList.remove('stopped');            
            this._btns_startstop[i].className+= " started";
        }
        
        this._start = new Date()-this._diff;
        this._start = new Date(this._start);
        this.timer();

        if (typeof settings.onResume == 'function')
        {
            (settings.onResume)();
        }

        this.startRun();
    }

    /**
     * 
     */
    this.reset = function() 
    {
        this._start = new Date();
        this.resetScreen();

        if (typeof settings.onReset == 'function')
        {
            (settings.onReset)();
        }
    }

    /**
     * 
     */
    this.resetScreen = function()
    {
        var output = '';
            output+= settings.showHour ? '00' : '';
            output+= settings.showMin ? settings.separator + '00' : '';
            output+= settings.showSec ? settings.separator + '00' : '';
            output+= settings.showMsec ? settings.separator + '000' : '';
        
        for (var i=0; i<that._screens.length; i++)
        {
            setElementText( that._screens[i], output );
        }
    }

    /**
     * 
     */
    this.startRun = function()
    {
        if (runs[runID] == undefined)
        {
            var run = {
                ID: runID,
                start: new Date(),
                end: null,
                duration: 0,
            }

            runs[runID] = run;
        }
    }

    /**
     * 
     */
    this.stopRun = function()
    {
        var duration = 0
        var formatedDuration = {
            hour: 0,
            min: 0,
            sec: 0,
            msec: 0
        }

        if (runs[runID-1] == undefined)
        {
            duration = this._diff - 0;
        }
        else
        {
            duration = this._diff - 0 - previousRunDuration;
        }

        var _duration = new Date(duration);
        formatedDuration.hour = _duration.getHours()-1;
        formatedDuration.min = _duration.getMinutes();
        formatedDuration.sec = _duration.getSeconds();
        formatedDuration.msec = _duration.getMilliseconds();

        formatedDuration.hour = pad(formatedDuration.hour, 2);
        formatedDuration.min = pad(formatedDuration.min, 2);
        formatedDuration.sec = pad(formatedDuration.sec, 2);
        formatedDuration.msec = pad(formatedDuration.msec, 3);
        formatedDuration.base = duration;

        runs[runID].end = new Date();
        runs[runID].duration = formatedDuration;
        // runs[runID].previousRunDuration = previousRunDuration;
        runID++;

        previousRunDuration += duration;

        console.log( runs );
    }

    /**
     * ZeroFill
     */
    function pad (number, length) 
    {
        var str = '' + number;
        while (str.length < length) 
        {
            str = '0' + str;
        }
        return str;
    }

    /**
     * Set a text to HTML element
     */
    function setElementText( element, text ) 
    {
        if (element.tagName == 'INPUT')
        {
            element.value = text;
        }
        else 
        {
            element.innerHTML = text;
        }
    }

    /**
     * 
     */
    function init () 
    {
        // Timer screen text value
        that.resetScreen();

        // Start/Stop Button
        for (var i=0; i<that._btns_startstop.length ; i++)
        {
            // Start/Stop Button text
            setElementText( that._btns_startstop[i], settings.textStart );

            // Start/Stop button action
            if (that._btns_startstop[i].onclick == null)
            {
                that._btns_startstop[i].onclick = function(){ that.start(); };
            }
            
            that._btns_startstop[i].className+= " stopped";
        }

        // Reset Button
        for (var i=0; i<that._btns_reset.length ; i++)
        {
            setElementText( that._btns_reset[i], settings.textReset );
            
            // Start/Stop button action
            if (that._btns_reset[i].onclick == null)
            {
                that._btns_reset[i].onclick = function(){ that.reset(); };
            }
        }

        if (settings.autoStart)
        {
            that.start();
        }
    }

    init();
};