<?php
return array(
    // set your paypal credential
    'client_id' => 'AWINSU8eKvnpA4iw-dwo3MGiw4dS9OEaJpyMmFNwpsure6dz-TD80fxgJXXjTTktu6niydgI3ehNFaw7',
    'secret' => 'EK3Vn2A0LZxW-JvDc9DnDL3i24iPaPhEvP-BhZrlpYn6G2QeZecTBUyyqIFy3B9RXnvzFTnUSHyFzuXZ',
 
    /**
     * SDK configuration 
     */
    'settings' => array(
        /**
         * Available option 'sandbox' or 'live'
         */
        'mode' => 'sandbox',
 
        /**
         * Specify the max request time in seconds
         */
        'http.ConnectionTimeOut' => 30,
 
        /**
         * Whether want to log to a file
         */
        'log.LogEnabled' => true,
 
        /**
         * Specify the file that want to write on
         */
        'log.FileName' => storage_path() . '/logs/paypal.log',
 
        /**
         * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
         *
         * Logging is most verbose in the 'FINE' level and decreases as you
         * proceed towards ERROR
         */
        'log.LogLevel' => 'FINE'
    ),
);