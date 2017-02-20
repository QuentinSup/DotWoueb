declare var HttpStatus: {
    OK: number;
    Created: number;
    Accepted: number;
    NoContent: number;
    Reset: number;
    PartialContent: number;
    MultiStatus: number;
    NotModified: number;
    BadRequest: number;
    Unauthorized: number;
    PaymentRequired: number;
    Forbidden: number;
    NotFound: number;
    MethodNotAllowed: number;
    NotAcceptable: number;
    RequestTimeOut: number;
    Conflict: number;
    Gone: number;
    PreconditionFailed: number;
    ExpectationFailed: number;
    Locked: number;
    MethodFailure: number;
    UpgradeRequired: number;
    PreconditionRequired: number;
    TooManyRequests: number;
    UnavailableForLegalReasons: number;
    UnrecoverableError: number;
    NoResponse: number;
    InternalServerError: number;
    NotImplemented: number;
    ServiceUnavailable: number;
    UnknownError: number;
};// Type definitions for jQuery 1.10.x / 2.0.x
// Project: http://jquery.com/
// Definitions by: Boris Yankov <https://github.com/borisyankov/>, Christian Hoffmeister <https://github.com/choffmeister>, Steve Fenton <https://github.com/Steve-Fenton>, Diullei Gomes <https://github.com/Diullei>, Tass Iliopoulos <https://github.com/tasoili>, Jason Swearingen <https://github.com/jasons-novaleaf>, Sean Hill <https://github.com/seanski>, Guus Goossens <https://github.com/Guuz>, Kelly Summerlin <https://github.com/ksummerlin>, Basarat Ali Syed <https://github.com/basarat>, Nicholas Wolverson <https://github.com/nwolverson>, Derek Cicerone <https://github.com/derekcicerone>, Andrew Gaspar <https://github.com/AndrewGaspar>, James Harrison Fisher <https://github.com/jameshfisher>, Seikichi Kondo <https://github.com/seikichi>, Benjamin Jackman <https://github.com/benjaminjackman>, Poul Sorensen <https://github.com/s093294>, Josh Strobl <https://github.com/JoshStrobl>, John Reilly <https://github.com/johnnyreilly/>
// Definitions: https://github.com/borisyankov/DefinitelyTyped

/* *****************************************************************************
Copyright (c) Microsoft Corporation. All rights reserved.
Licensed under the Apache License, Version 2.0 (the "License"); you may not use
this file except in compliance with the License. You may obtain a copy of the
License at http://www.apache.org/licenses/LICENSE-2.0

THIS CODE IS PROVIDED *AS IS* BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
KIND, EITHER EXPRESS OR IMPLIED, INCLUDING WITHOUT LIMITATION ANY IMPLIED
WARRANTIES OR CONDITIONS OF TITLE, FITNESS FOR A PARTICULAR PURPOSE,
MERCHANTABLITY OR NON-INFRINGEMENT.

See the Apache Version 2.0 License for specific language governing permissions
and limitations under the License.
***************************************************************************** */


/**
 * Interface for the AJAX setting that will configure the AJAX request
 */
interface JQueryAjaxSettings {
    /**
     * The content type sent in the request header that tells the server what kind of response it will accept in return. If the accepts setting needs modification, it is recommended to do so once in the $.ajaxSetup() method.
     */
    accepts?: any;
    /**
     * By default, all requests are sent asynchronously (i.e. this is set to true by default). If you need synchronous requests, set this option to false. Cross-domain requests and dataType: "jsonp" requests do not support synchronous operation. Note that synchronous requests may temporarily lock the browser, disabling any actions while the request is active. As of jQuery 1.8, the use of async: false with jqXHR ($.Deferred) is deprecated; you must use the success/error/complete callback options instead of the corresponding methods of the jqXHR object such as jqXHR.done() or the deprecated jqXHR.success().
     */
    async?: boolean;
    /**
     * A pre-request callback function that can be used to modify the jqXHR (in jQuery 1.4.x, XMLHTTPRequest) object before it is sent. Use this to set custom headers, etc. The jqXHR and settings objects are passed as arguments. This is an Ajax Event. Returning false in the beforeSend function will cancel the request. As of jQuery 1.5, the beforeSend option will be called regardless of the type of request.
     */
    beforeSend? (jqXHR: JQueryXHR, settings: JQueryAjaxSettings): any;
    /**
     * If set to false, it will force requested pages not to be cached by the browser. Note: Setting cache to false will only work correctly with HEAD and GET requests. It works by appending "_={timestamp}" to the GET parameters. The parameter is not needed for other types of requests, except in IE8 when a POST is made to a URL that has already been requested by a GET.
     */
    cache?: boolean;
    /**
     * A function to be called when the request finishes (after success and error callbacks are executed). The function gets passed two arguments: The jqXHR (in jQuery 1.4.x, XMLHTTPRequest) object and a string categorizing the status of the request ("success", "notmodified", "error", "timeout", "abort", or "parsererror"). As of jQuery 1.5, the complete setting can accept an array of functions. Each function will be called in turn. This is an Ajax Event.
     */
    complete? (jqXHR: JQueryXHR, textStatus: string): any;
    /**
     * An object of string/regular-expression pairs that determine how jQuery will parse the response, given its content type. (version added: 1.5)
     */
    contents?: { [key: string]: any; };
    //According to jQuery.ajax source code, ajax's option actually allows contentType to set to "false"
    // https://github.com/borisyankov/DefinitelyTyped/issues/742
    /**
     * When sending data to the server, use this content type. Default is "application/x-www-form-urlencoded; charset=UTF-8", which is fine for most cases. If you explicitly pass in a content-type to $.ajax(), then it is always sent to the server (even if no data is sent). The W3C XMLHttpRequest specification dictates that the charset is always UTF-8; specifying another charset will not force the browser to change the encoding.
     */
    contentType?: any;
    /**
     * This object will be made the context of all Ajax-related callbacks. By default, the context is an object that represents the ajax settings used in the call ($.ajaxSettings merged with the settings passed to $.ajax).
     */
    context?: any;
    /**
     * An object containing dataType-to-dataType converters. Each converter's value is a function that returns the transformed value of the response. (version added: 1.5)
     */
    converters?: { [key: string]: any; };
    /**
     * If you wish to force a crossDomain request (such as JSONP) on the same domain, set the value of crossDomain to true. This allows, for example, server-side redirection to another domain. (version added: 1.5)
     */
    crossDomain?: boolean;
    /**
     * Data to be sent to the server. It is converted to a query string, if not already a string. It's appended to the url for GET-requests. See processData option to prevent this automatic processing. Object must be Key/Value pairs. If value is an Array, jQuery serializes multiple values with same key based on the value of the traditional setting (described below).
     */
    data?: any;
    /**
     * A function to be used to handle the raw response data of XMLHttpRequest.This is a pre-filtering function to sanitize the response. You should return the sanitized data. The function accepts two arguments: The raw data returned from the server and the 'dataType' parameter.
     */
    dataFilter? (data: any, ty: any): any;
    /**
     * The type of data that you're expecting back from the server. If none is specified, jQuery will try to infer it based on the MIME type of the response (an XML MIME type will yield XML, in 1.4 JSON will yield a JavaScript object, in 1.4 script will execute the script, and anything else will be returned as a string). 
     */
    dataType?: string;
    /**
     * A function to be called if the request fails. The function receives three arguments: The jqXHR (in jQuery 1.4.x, XMLHttpRequest) object, a string describing the type of error that occurred and an optional exception object, if one occurred. Possible values for the second argument (besides null) are "timeout", "error", "abort", and "parsererror". When an HTTP error occurs, errorThrown receives the textual portion of the HTTP status, such as "Not Found" or "Internal Server Error." As of jQuery 1.5, the error setting can accept an array of functions. Each function will be called in turn. Note: This handler is not called for cross-domain script and cross-domain JSONP requests. This is an Ajax Event.
     */
    error? (jqXHR: JQueryXHR, textStatus: string, errorThrown: string): any;
    /**
     * Whether to trigger global Ajax event handlers for this request. The default is true. Set to false to prevent the global handlers like ajaxStart or ajaxStop from being triggered. This can be used to control various Ajax Events.
     */
    global?: boolean;
    /**
     * An object of additional header key/value pairs to send along with requests using the XMLHttpRequest transport. The header X-Requested-With: XMLHttpRequest is always added, but its default XMLHttpRequest value can be changed here. Values in the headers setting can also be overwritten from within the beforeSend function. (version added: 1.5)
     */
    headers?: { [key: string]: any; };
    /**
     * Allow the request to be successful only if the response has changed since the last request. This is done by checking the Last-Modified header. Default value is false, ignoring the header. In jQuery 1.4 this technique also checks the 'etag' specified by the server to catch unmodified data.
     */
    ifModified?: boolean;
    /**
     * Allow the current environment to be recognized as "local," (e.g. the filesystem), even if jQuery does not recognize it as such by default. The following protocols are currently recognized as local: file, *-extension, and widget. If the isLocal setting needs modification, it is recommended to do so once in the $.ajaxSetup() method. (version added: 1.5.1)
     */
    isLocal?: boolean;
    /**
     * Override the callback function name in a jsonp request. This value will be used instead of 'callback' in the 'callback=?' part of the query string in the url. So {jsonp:'onJSONPLoad'} would result in 'onJSONPLoad=?' passed to the server. As of jQuery 1.5, setting the jsonp option to false prevents jQuery from adding the "?callback" string to the URL or attempting to use "=?" for transformation. In this case, you should also explicitly set the jsonpCallback setting. For example, { jsonp: false, jsonpCallback: "callbackName" }
     */
    jsonp?: any;
    /**
     * Specify the callback function name for a JSONP request. This value will be used instead of the random name automatically generated by jQuery. It is preferable to let jQuery generate a unique name as it'll make it easier to manage the requests and provide callbacks and error handling. You may want to specify the callback when you want to enable better browser caching of GET requests. As of jQuery 1.5, you can also use a function for this setting, in which case the value of jsonpCallback is set to the return value of that function.
     */
    jsonpCallback?: any;
    /**
     * A mime type to override the XHR mime type. (version added: 1.5.1)
     */
    mimeType?: string;
    /**
     * A password to be used with XMLHttpRequest in response to an HTTP access authentication request.
     */
    password?: string;
    /**
     * By default, data passed in to the data option as an object (technically, anything other than a string) will be processed and transformed into a query string, fitting to the default content-type "application/x-www-form-urlencoded". If you want to send a DOMDocument, or other non-processed data, set this option to false.
     */
    processData?: boolean;
    /**
     * Only applies when the "script" transport is used (e.g., cross-domain requests with "jsonp" or "script" dataType and "GET" type). Sets the charset attribute on the script tag used in the request. Used when the character set on the local page is not the same as the one on the remote script.
     */
    scriptCharset?: string;
    /**
     * An object of numeric HTTP codes and functions to be called when the response has the corresponding code. f the request is successful, the status code functions take the same parameters as the success callback; if it results in an error (including 3xx redirect), they take the same parameters as the error callback. (version added: 1.5)
     */
    statusCode?: { [key: string]: any; };
    /**
     * A function to be called if the request succeeds. The function gets passed three arguments: The data returned from the server, formatted according to the dataType parameter; a string describing the status; and the jqXHR (in jQuery 1.4.x, XMLHttpRequest) object. As of jQuery 1.5, the success setting can accept an array of functions. Each function will be called in turn. This is an Ajax Event.
     */
    success? (data: any, textStatus: string, jqXHR: JQueryXHR): any;
    /**
     * Set a timeout (in milliseconds) for the request. This will override any global timeout set with $.ajaxSetup(). The timeout period starts at the point the $.ajax call is made; if several other requests are in progress and the browser has no connections available, it is possible for a request to time out before it can be sent. In jQuery 1.4.x and below, the XMLHttpRequest object will be in an invalid state if the request times out; accessing any object members may throw an exception. In Firefox 3.0+ only, script and JSONP requests cannot be cancelled by a timeout; the script will run even if it arrives after the timeout period.
     */
    timeout?: number;
    /**
     * Set this to true if you wish to use the traditional style of param serialization.
     */
    traditional?: boolean;
    /**
     * The type of request to make ("POST" or "GET"), default is "GET". Note: Other HTTP request methods, such as PUT and DELETE, can also be used here, but they are not supported by all browsers.
     */
    type?: string;
    /**
     * A string containing the URL to which the request is sent.
     */
    url?: string;
    /**
     * A username to be used with XMLHttpRequest in response to an HTTP access authentication request.
     */
    username?: string;
    /**
     * Callback for creating the XMLHttpRequest object. Defaults to the ActiveXObject when available (IE), the XMLHttpRequest otherwise. Override to provide your own implementation for XMLHttpRequest or enhancements to the factory.
     */
    xhr?: any;
    /**
     * An object of fieldName-fieldValue pairs to set on the native XHR object. For example, you can use it to set withCredentials to true for cross-domain requests if needed. In jQuery 1.5, the withCredentials property was not propagated to the native XHR and thus CORS requests requiring it would ignore this flag. For this reason, we recommend using jQuery 1.5.1+ should you require the use of it. (version added: 1.5.1)
     */
    xhrFields?: { [key: string]: any; };
}

/**
 * Interface for the jqXHR object
 */
interface JQueryXHR extends XMLHttpRequest, JQueryPromise<any> {
    /**
     * The .overrideMimeType() method may be used in the beforeSend() callback function, for example, to modify the response content-type header. As of jQuery 1.5.1, the jqXHR object also contains the overrideMimeType() method (it was available in jQuery 1.4.x, as well, but was temporarily removed in jQuery 1.5). 
     */
    overrideMimeType(mimeType: string): any;
    /**
     * Cancel the request. 
     *
     * @param statusText A string passed as the textStatus parameter for the done callback. Default value: "canceled"
     */
    abort(statusText?: string): void;
    /**
     * Incorporates the functionality of the .done() and .fail() methods, allowing (as of jQuery 1.8) the underlying Promise to be manipulated. Refer to deferred.then() for implementation details.
     */
    then(doneCallback: (data: any, textStatus: string, jqXHR: JQueryXHR) => void, failCallback?: (jqXHR: JQueryXHR, textStatus: string, errorThrown: any) => void): JQueryPromise<any>;
    /**
     * Property containing the parsed response if the response Content-Type is json
     */
    responseJSON?: any;
}

/**
 * Interface for the JQuery callback
 */
interface JQueryCallback {
    /**
     * Add a callback or a collection of callbacks to a callback list.
     * 
     * @param callbacks A function, or array of functions, that are to be added to the callback list.
     */
    add(callbacks: Function): JQueryCallback;
    /**
     * Add a callback or a collection of callbacks to a callback list.
     * 
     * @param callbacks A function, or array of functions, that are to be added to the callback list.
     */
    add(callbacks: Function[]): JQueryCallback;

    /**
     * Disable a callback list from doing anything more.
     */
    disable(): JQueryCallback;

    /**
     * Determine if the callbacks list has been disabled.
     */
    disabled(): boolean;

    /**
     * Remove all of the callbacks from a list.
     */
    empty(): JQueryCallback;

    /**
     * Call all of the callbacks with the given arguments
     * 
     * @param arguments The argument or list of arguments to pass back to the callback list.
     */
    fire(...arguments: any[]): JQueryCallback;

    /**
     * Determine if the callbacks have already been called at least once.
     */
    fired(): boolean;

    /**
     * Call all callbacks in a list with the given context and arguments.
     * 
     * @param context A reference to the context in which the callbacks in the list should be fired.
     * @param arguments An argument, or array of arguments, to pass to the callbacks in the list.
     */
    fireWith(context?: any, ...args: any[]): JQueryCallback;

    /**
     * Determine whether a supplied callback is in a list
     * 
     * @param callback The callback to search for.
     */
    has(callback: Function): boolean;

    /**
     * Lock a callback list in its current state.
     */
    lock(): JQueryCallback;

    /**
     * Determine if the callbacks list has been locked.
     */
    locked(): boolean;

    /**
     * Remove a callback or a collection of callbacks from a callback list.
     * 
     * @param callbacks A function, or array of functions, that are to be removed from the callback list.
     */
    remove(callbacks: Function): JQueryCallback;
    /**
     * Remove a callback or a collection of callbacks from a callback list.
     * 
     * @param callbacks A function, or array of functions, that are to be removed from the callback list.
     */
    remove(callbacks: Function[]): JQueryCallback;
}

/**
 * Allows jQuery Promises to interop with non-jQuery promises
 */
interface JQueryGenericPromise<T> {
    /**
     * Add handlers to be called when the Deferred object is resolved, rejected, or still in progress.
     * 
     * @param doneFilter A function that is called when the Deferred is resolved.
     * @param failFilter An optional function that is called when the Deferred is rejected.
     */
    then<U>(doneFilter: (value: T) => U, failFilter?: (reason: any) => U): JQueryGenericPromise<U>;
    /**
     * Add handlers to be called when the Deferred object is resolved, rejected, or still in progress.
     * 
     * @param doneFilter A function that is called when the Deferred is resolved.
     * @param failFilter An optional function that is called when the Deferred is rejected.
     */
    then<U>(doneFilter: (value: T) => JQueryGenericPromise<U>, failFilter?: (reason: any) => U): JQueryGenericPromise<U>;
    /**
     * Add handlers to be called when the Deferred object is resolved, rejected, or still in progress.
     * 
     * @param doneFilter A function that is called when the Deferred is resolved.
     * @param failFilter An optional function that is called when the Deferred is rejected.
     */
    then<U>(doneFilter: (value: T) => U, failFilter?: (reason: any) => JQueryGenericPromise<U>): JQueryGenericPromise<U>;
    /**
     * Add handlers to be called when the Deferred object is resolved, rejected, or still in progress.
     * 
     * @param doneFilter A function that is called when the Deferred is resolved.
     * @param failFilter An optional function that is called when the Deferred is rejected.
     */
    then<U>(doneFilter: (value: T) => JQueryGenericPromise<U>, failFilter?: (reason: any) => JQueryGenericPromise<U>): JQueryGenericPromise<U>;
}

/**
 * Interface for the JQuery promise/deferred callbacks
 */
interface JQueryPromiseCallback<T> {
    (value?: T, ...args: any[]): void;
}

/**
 * Interface for the JQuery promise, part of callbacks
 */
interface JQueryPromise<T> {
    /**
     * Add handlers to be called when the Deferred object is either resolved or rejected.
     * 
     * @param alwaysCallbacks1 A function, or array of functions, that is called when the Deferred is resolved or rejected.
     * @param alwaysCallbacks2 Optional additional functions, or arrays of functions, that are called when the Deferred is resolved or rejected.
     */
    always(alwaysCallbacks1?: JQueryPromiseCallback<T>, ...alwaysCallbacks2: JQueryPromiseCallback<T>[]): JQueryDeferred<T>;
    /**
     * Add handlers to be called when the Deferred object is resolved.
     * 
     * @param doneCallbacks1 A function, or array of functions, that are called when the Deferred is resolved.
     * @param doneCallbacks2 Optional additional functions, or arrays of functions, that are called when the Deferred is resolved.
     */
    done(doneCallbacks1?: JQueryPromiseCallback<T>, ...doneCallbacks2: JQueryPromiseCallback<T>[]): JQueryDeferred<T>;
    /**
     * Add handlers to be called when the Deferred object is rejected.
     * 
     * @param failCallbacks1 A function, or array of functions, that are called when the Deferred is rejected.
     * @param failCallbacks2 Optional additional functions, or arrays of functions, that are called when the Deferred is rejected.
     */
    fail(failCallbacks1?: JQueryPromiseCallback<T>, ...failCallbacks2: JQueryPromiseCallback<T>[]): JQueryDeferred<T>;
    /**
     * Add handlers to be called when the Deferred object generates progress notifications.
     * 
     * @param progressCallbacks A function, or array of functions, to be called when the Deferred generates progress notifications.
     */
    progress(...progressCallbacks: JQueryPromiseCallback<T>[]): JQueryDeferred<T>;

    /**
     * Add handlers to be called when the Deferred object is either resolved or rejected.
     * 
     * @param alwaysCallbacks A function, or array of functions, that is called when the Deferred is resolved or rejected.
     */
    always(...alwaysCallbacks: any[]): JQueryPromise<T>;
    /**
     * Add handlers to be called when the Deferred object is resolved.
     * 
     * @param doneCallbacks A function, or array of functions, that are called when the Deferred is resolved.
     */
    done(...doneCallbacks: any[]): JQueryPromise<T>;
    /**
     * Add handlers to be called when the Deferred object is rejected.
     * 
     * @param failCallbacks A function, or array of functions, that are called when the Deferred is rejected.
     */
    fail(...failCallbacks: any[]): JQueryPromise<T>;
    /**
     * Add handlers to be called when the Deferred object generates progress notifications.
     * 
     * @param progressCallbacks A function, or array of functions, to be called when the Deferred generates progress notifications.
     */
    progress(...progressCallbacks: any[]): JQueryPromise<T>;

    /**
     * Determine the current state of a Deferred object.
     */
    state(): string;

    // Deprecated - given no typings
    pipe(doneFilter?: (x: any) => any, failFilter?: (x: any) => any, progressFilter?: (x: any) => any): JQueryPromise<any>;

    /**
     * Add handlers to be called when the Deferred object is resolved, rejected, or still in progress.
     * 
     * @param doneFilter A function that is called when the Deferred is resolved.
     * @param failFilter An optional function that is called when the Deferred is rejected.
     * @param progressFilter An optional function that is called when progress notifications are sent to the Deferred.
     */
    then<U>(doneFilter: (value: T) => U, failFilter?: (...reasons: any[]) => U, progressFilter?: (...progression: any[]) => any): JQueryPromise<U>;
    /**
     * Add handlers to be called when the Deferred object is resolved, rejected, or still in progress.
     * 
     * @param doneFilter A function that is called when the Deferred is resolved.
     * @param failFilter An optional function that is called when the Deferred is rejected.
     * @param progressFilter An optional function that is called when progress notifications are sent to the Deferred.
     */
    then<U>(doneFilter: (value: T) => JQueryGenericPromise<U>, failFilter?: (...reasons: any[]) => U, progressFilter?: (...progression: any[]) => any): JQueryPromise<U>;
    /**
     * Add handlers to be called when the Deferred object is resolved, rejected, or still in progress.
     * 
     * @param doneFilter A function that is called when the Deferred is resolved.
     * @param failFilter An optional function that is called when the Deferred is rejected.
     * @param progressFilter An optional function that is called when progress notifications are sent to the Deferred.
     */
    then<U>(doneFilter: (value: T) => U, failFilter?: (...reasons: any[]) => JQueryGenericPromise<U>, progressFilter?: (...progression: any[]) => any): JQueryPromise<U>;
    /**
     * Add handlers to be called when the Deferred object is resolved, rejected, or still in progress.
     * 
     * @param doneFilter A function that is called when the Deferred is resolved.
     * @param failFilter An optional function that is called when the Deferred is rejected.
     * @param progressFilter An optional function that is called when progress notifications are sent to the Deferred.
     */
    then<U>(doneFilter: (value: T) => JQueryGenericPromise<U>, failFilter?: (...reasons: any[]) => JQueryGenericPromise<U>, progressFilter?: (...progression: any[]) => any): JQueryPromise<U>;

    // Because JQuery Promises Suck
    /**
     * Add handlers to be called when the Deferred object is resolved, rejected, or still in progress.
     * 
     * @param doneFilter A function that is called when the Deferred is resolved.
     * @param failFilter An optional function that is called when the Deferred is rejected.
     * @param progressFilter An optional function that is called when progress notifications are sent to the Deferred.
     */
    then<U>(doneFilter: (...values: any[]) => U, failFilter?: (...reasons: any[]) => U, progressFilter?: (...progression: any[]) => any): JQueryPromise<U>;
    /**
     * Add handlers to be called when the Deferred object is resolved, rejected, or still in progress.
     * 
     * @param doneFilter A function that is called when the Deferred is resolved.
     * @param failFilter An optional function that is called when the Deferred is rejected.
     * @param progressFilter An optional function that is called when progress notifications are sent to the Deferred.
     */
    then<U>(doneFilter: (...values: any[]) => JQueryGenericPromise<U>, failFilter?: (...reasons: any[]) => U, progressFilter?: (...progression: any[]) => any): JQueryPromise<U>;
    /**
     * Add handlers to be called when the Deferred object is resolved, rejected, or still in progress.
     * 
     * @param doneFilter A function that is called when the Deferred is resolved.
     * @param failFilter An optional function that is called when the Deferred is rejected.
     * @param progressFilter An optional function that is called when progress notifications are sent to the Deferred.
     */
    then<U>(doneFilter: (...values: any[]) => U, failFilter?: (...reasons: any[]) => JQueryGenericPromise<U>, progressFilter?: (...progression: any[]) => any): JQueryPromise<U>;
    /**
     * Add handlers to be called when the Deferred object is resolved, rejected, or still in progress.
     * 
     * @param doneFilter A function that is called when the Deferred is resolved.
     * @param failFilter An optional function that is called when the Deferred is rejected.
     * @param progressFilter An optional function that is called when progress notifications are sent to the Deferred.
     */
    then<U>(doneFilter: (...values: any[]) => JQueryGenericPromise<U>, failFilter?: (...reasons: any[]) => JQueryGenericPromise<U>, progressFilter?: (...progression: any[]) => any): JQueryPromise<U>;
}

/**
 * Interface for the JQuery deferred, part of callbacks
 */
interface JQueryDeferred<T> extends JQueryPromise<T> {
    /**
     * Add handlers to be called when the Deferred object is either resolved or rejected.
     * 
     * @param alwaysCallbacks1 A function, or array of functions, that is called when the Deferred is resolved or rejected.
     * @param alwaysCallbacks2 Optional additional functions, or arrays of functions, that are called when the Deferred is resolved or rejected.
     */
    always(alwaysCallbacks1?: JQueryPromiseCallback<T>, ...alwaysCallbacks2: JQueryPromiseCallback<T>[]): JQueryDeferred<T>;
    always(alwaysCallbacks1?: JQueryPromiseCallback<T>[], ...alwaysCallbacks2: JQueryPromiseCallback<T>[]): JQueryDeferred<T>;
    always(alwaysCallbacks1?: JQueryPromiseCallback<T>, ...alwaysCallbacks2: any[]): JQueryDeferred<T>;
    always(alwaysCallbacks1?: JQueryPromiseCallback<T>[], ...alwaysCallbacks2: any[]): JQueryDeferred<T>;
    /**
     * Add handlers to be called when the Deferred object is resolved.
     * 
     * @param doneCallbacks1 A function, or array of functions, that are called when the Deferred is resolved.
     * @param doneCallbacks2 Optional additional functions, or arrays of functions, that are called when the Deferred is resolved.
     */
    done(doneCallbacks1?: JQueryPromiseCallback<T>, ...doneCallbacks2: JQueryPromiseCallback<T>[]): JQueryDeferred<T>;
    done(doneCallbacks1?: JQueryPromiseCallback<T>[], ...doneCallbacks2: JQueryPromiseCallback<T>[]): JQueryDeferred<T>;
    done(doneCallbacks1?: JQueryPromiseCallback<T>, ...doneCallbacks2: any[]): JQueryDeferred<T>;
    done(doneCallbacks1?: JQueryPromiseCallback<T>[], ...doneCallbacks2: any[]): JQueryDeferred<T>;
    /**
     * Add handlers to be called when the Deferred object is rejected.
     * 
     * @param failCallbacks1 A function, or array of functions, that are called when the Deferred is rejected.
     * @param failCallbacks2 Optional additional functions, or arrays of functions, that are called when the Deferred is rejected.
     */
    fail(failCallbacks1?: JQueryPromiseCallback<T>, ...failCallbacks2: JQueryPromiseCallback<T>[]): JQueryDeferred<T>;
    fail(failCallbacks1?: JQueryPromiseCallback<T>[], ...failCallbacks2: JQueryPromiseCallback<T>[]): JQueryDeferred<T>;
    fail(failCallbacks1?: JQueryPromiseCallback<T>, ...failCallbacks2: any[]): JQueryDeferred<T>;
    fail(failCallbacks1?: JQueryPromiseCallback<T>[], ...failCallbacks2: any[]): JQueryDeferred<T>;
    /**
     * Add handlers to be called when the Deferred object generates progress notifications.
     * 
     * @param progressCallbacks A function, or array of functions, to be called when the Deferred generates progress notifications.
     */
    progress(...progressCallbacks: JQueryPromiseCallback<T>[]): JQueryDeferred<T>;

    /**
     * Call the progressCallbacks on a Deferred object with the given args.
     * 
     * @param args Optional arguments that are passed to the progressCallbacks.
     */
    notify(...args: any[]): JQueryDeferred<T>;

    /**
     * Call the progressCallbacks on a Deferred object with the given context and args.
     * 
     * @param context Context passed to the progressCallbacks as the this object.
     * @param args Optional arguments that are passed to the progressCallbacks.
     */
    notifyWith(context: any, ...args: any[]): JQueryDeferred<T>;

    /**
     * Reject a Deferred object and call any failCallbacks with the given args.
     * 
     * @param args Optional arguments that are passed to the failCallbacks.
     */
    reject(...args: any[]): JQueryDeferred<T>;
    /**
     * Reject a Deferred object and call any failCallbacks with the given context and args.
     * 
     * @param context Context passed to the failCallbacks as the this object.
     * @param args An optional array of arguments that are passed to the failCallbacks.
     */
    rejectWith(context: any, ...args: any[]): JQueryDeferred<T>;

    /**
     * Resolve a Deferred object and call any doneCallbacks with the given args.
     * 
     * @param value First argument passed to doneCallbacks.
     * @param args Optional subsequent arguments that are passed to the doneCallbacks.
     */
    resolve(value?: T, ...args: any[]): JQueryDeferred<T>;

    /**
     * Resolve a Deferred object and call any doneCallbacks with the given context and args.
     * 
     * @param context Context passed to the doneCallbacks as the this object.
     * @param args An optional array of arguments that are passed to the doneCallbacks.
     */
    resolveWith(context: any, ...args: any[]): JQueryDeferred<T>;
    /**
     * Determine the current state of a Deferred object.
     */
    state(): string;

    /**
     * Return a Deferred's Promise object.
     * 
     * @param target Object onto which the promise methods have to be attached
     */
    promise(target?: any): JQueryPromise<T>;
}

/**
 * Interface of the JQuery extension of the W3C event object
 */
interface BaseJQueryEventObject extends Event {
    data: any;
    delegateTarget: Element;
    isDefaultPrevented(): boolean;
    isImmediatePropagationStopped(): boolean;
    isPropagationStopped(): boolean;
    namespace: string;
    preventDefault(): any;
    relatedTarget: Element;
    result: any;
    stopImmediatePropagation(): void;
    stopPropagation(): void;
    pageX: number;
    pageY: number;
    which: number;
    metaKey: boolean;
}

interface JQueryInputEventObject extends BaseJQueryEventObject {
    altKey: boolean;
    ctrlKey: boolean;
    metaKey: boolean;
    shiftKey: boolean;
}

interface JQueryMouseEventObject extends JQueryInputEventObject {
    button: number;
    clientX: number;
    clientY: number;
    offsetX: number;
    offsetY: number;
    pageX: number;
    pageY: number;
    screenX: number;
    screenY: number;
}

interface JQueryKeyEventObject extends JQueryInputEventObject {
    char: any;
    charCode: number;
    key: any;
    keyCode: number;
}

interface JQueryPopStateEventObject extends BaseJQueryEventObject {
    originalEvent: PopStateEvent;
}

interface JQueryEventObject extends BaseJQueryEventObject, JQueryInputEventObject, JQueryMouseEventObject, JQueryKeyEventObject, JQueryPopStateEventObject {
}

/*
    Collection of properties of the current browser
*/

interface JQuerySupport {
    ajax?: boolean;
    boxModel?: boolean;
    changeBubbles?: boolean;
    checkClone?: boolean;
    checkOn?: boolean;
    cors?: boolean;
    cssFloat?: boolean;
    hrefNormalized?: boolean;
    htmlSerialize?: boolean;
    leadingWhitespace?: boolean;
    noCloneChecked?: boolean;
    noCloneEvent?: boolean;
    opacity?: boolean;
    optDisabled?: boolean;
    optSelected?: boolean;
    scriptEval? (): boolean;
    style?: boolean;
    submitBubbles?: boolean;
    tbody?: boolean;
}

interface JQueryParam {
    /**
     * Create a serialized representation of an array or object, suitable for use in a URL query string or Ajax request.
     * 
     * @param obj An array or object to serialize.
     */
    (obj: any): string;

    /**
     * Create a serialized representation of an array or object, suitable for use in a URL query string or Ajax request.
     * 
     * @param obj An array or object to serialize.
     * @param traditional A Boolean indicating whether to perform a traditional "shallow" serialization.
     */
    (obj: any, traditional: boolean): string;
}

/**
 * The interface used to construct jQuery events (with $.Event). It is
 * defined separately instead of inline in JQueryStatic to allow
 * overriding the construction function with specific strings
 * returning specific event objects.
 */
interface JQueryEventConstructor {
    (name: string, eventProperties?: any): JQueryEventObject;
    new (name: string, eventProperties?: any): JQueryEventObject;
}

/**
 * The interface used to specify coordinates.
 */
interface JQueryCoordinates {
    left: number;
    top: number;
}

interface JQueryAnimationOptions { 
    /**
     * A string or number determining how long the animation will run.
     */
    duration?: any; 
    /**
     * A string indicating which easing function to use for the transition.
     */
    easing?: string; 
    /**
     * A function to call once the animation is complete.
     */
    complete?: Function; 
    /**
     * A function to be called for each animated property of each animated element. This function provides an opportunity to modify the Tween object to change the value of the property before it is set.
     */
    step?: (now: number, tween: any) => any; 
    /**
     * A function to be called after each step of the animation, only once per animated element regardless of the number of animated properties. (version added: 1.8)
     */
    progress?: (animation: JQueryPromise<any>, progress: number, remainingMs: number) => any; 
    /**
     * A function to call when the animation begins. (version added: 1.8)
     */
    start?: (animation: JQueryPromise<any>) => any; 
    /**
     * A function to be called when the animation completes (its Promise object is resolved). (version added: 1.8)
     */
    done?: (animation: JQueryPromise<any>, jumpedToEnd: boolean) => any; 
    /**
     * A function to be called when the animation fails to complete (its Promise object is rejected). (version added: 1.8)
     */
    fail?: (animation: JQueryPromise<any>, jumpedToEnd: boolean) => any; 
    /**
     * A function to be called when the animation completes or stops without completing (its Promise object is either resolved or rejected). (version added: 1.8)
     */
    always?: (animation: JQueryPromise<any>, jumpedToEnd: boolean) => any; 
    /**
     * A Boolean indicating whether to place the animation in the effects queue. If false, the animation will begin immediately. As of jQuery 1.7, the queue option can also accept a string, in which case the animation is added to the queue represented by that string. When a custom queue name is used the animation does not automatically start; you must call .dequeue("queuename") to start it.
     */
    queue?: any; 
    /**
     * A map of one or more of the CSS properties defined by the properties argument and their corresponding easing functions. (version added: 1.4)
     */
    specialEasing?: Object;
}

/**
 * Static members of jQuery (those on $ and jQuery themselves)
 */
interface JQueryStatic {

    /**
     * Perform an asynchronous HTTP (Ajax) request.
     *
     * @param settings A set of key/value pairs that configure the Ajax request. All settings are optional. A default can be set for any option with $.ajaxSetup().
     */
    ajax(settings: JQueryAjaxSettings): JQueryXHR;
    /**
     * Perform an asynchronous HTTP (Ajax) request.
     *
     * @param url A string containing the URL to which the request is sent.
     * @param settings A set of key/value pairs that configure the Ajax request. All settings are optional. A default can be set for any option with $.ajaxSetup().
     */
    ajax(url: string, settings?: JQueryAjaxSettings): JQueryXHR;

    /**
     * Handle custom Ajax options or modify existing options before each request is sent and before they are processed by $.ajax().
     *
     * @param dataTypes An optional string containing one or more space-separated dataTypes
     * @param handler A handler to set default values for future Ajax requests.
     */
    ajaxPrefilter(dataTypes: string, handler: (opts: any, originalOpts: JQueryAjaxSettings, jqXHR: JQueryXHR) => any): void;
    /**
     * Handle custom Ajax options or modify existing options before each request is sent and before they are processed by $.ajax().
     *
     * @param handler A handler to set default values for future Ajax requests.
     */
    ajaxPrefilter(handler: (opts: any, originalOpts: JQueryAjaxSettings, jqXHR: JQueryXHR) => any): void;

    ajaxSettings: JQueryAjaxSettings;

     /**
      * Set default values for future Ajax requests. Its use is not recommended.
      *
      * @param options A set of key/value pairs that configure the default Ajax request. All options are optional.
      */
    ajaxSetup(options: JQueryAjaxSettings): void;

    /**
     * Load data from the server using a HTTP GET request.
     *
     * @param url A string containing the URL to which the request is sent.
     * @param success A callback function that is executed if the request succeeds.
     * @param dataType The type of data expected from the server. Default: Intelligent Guess (xml, json, script, or html).
     */
    get(url: string, success?: (data: any, textStatus: string, jqXHR: JQueryXHR) => any, dataType?: string): JQueryXHR;
    /**
     * Load data from the server using a HTTP GET request.
     *
     * @param url A string containing the URL to which the request is sent.
     * @param data A plain object or string that is sent to the server with the request.
     * @param success A callback function that is executed if the request succeeds.
     * @param dataType The type of data expected from the server. Default: Intelligent Guess (xml, json, script, or html).
     */
    get(url: string, data?: Object, success?: (data: any, textStatus: string, jqXHR: JQueryXHR) => any, dataType?: string): JQueryXHR;
    /**
     * Load data from the server using a HTTP GET request.
     *
     * @param url A string containing the URL to which the request is sent.
     * @param data A plain object or string that is sent to the server with the request.
     * @param success A callback function that is executed if the request succeeds.
     * @param dataType The type of data expected from the server. Default: Intelligent Guess (xml, json, script, or html).
     */
    get(url: string, data?: string, success?: (data: any, textStatus: string, jqXHR: JQueryXHR) => any, dataType?: string): JQueryXHR;
    /**
     * Load JSON-encoded data from the server using a GET HTTP request.
     *
     * @param url A string containing the URL to which the request is sent.
     * @param success A callback function that is executed if the request succeeds.
     */
    getJSON(url: string, success?: (data: any, textStatus: string, jqXHR: JQueryXHR) => any): JQueryXHR;
    /**
     * Load JSON-encoded data from the server using a GET HTTP request.
     *
     * @param url A string containing the URL to which the request is sent.
     * @param data A plain object or string that is sent to the server with the request.
     * @param success A callback function that is executed if the request succeeds.
     */
    getJSON(url: string, data?: Object, success?: (data: any, textStatus: string, jqXHR: JQueryXHR) => any): JQueryXHR;
    /**
     * Load JSON-encoded data from the server using a GET HTTP request.
     *
     * @param url A string containing the URL to which the request is sent.
     * @param data A plain object or string that is sent to the server with the request.
     * @param success A callback function that is executed if the request succeeds.
     */
    getJSON(url: string, data?: string, success?: (data: any, textStatus: string, jqXHR: JQueryXHR) => any): JQueryXHR;
    /**
     * Load a JavaScript file from the server using a GET HTTP request, then execute it.
     *
     * @param url A string containing the URL to which the request is sent.
     * @param success A callback function that is executed if the request succeeds.
     */
    getScript(url: string, success?: (script: string, textStatus: string, jqXHR: JQueryXHR) => any): JQueryXHR;

    /**
     * Create a serialized representation of an array or object, suitable for use in a URL query string or Ajax request.
     */
    param: JQueryParam;

    /**
     * Load data from the server using a HTTP POST request.
     *
     * @param url A string containing the URL to which the request is sent.
     * @param success A callback function that is executed if the request succeeds. Required if dataType is provided, but can be null in that case.
     * @param dataType The type of data expected from the server. Default: Intelligent Guess (xml, json, script, text, html).
     */
    post(url: string, success?: (data: any, textStatus: string, jqXHR: JQueryXHR) => any, dataType?: string): JQueryXHR;
    /**
     * Load data from the server using a HTTP POST request.
     *
     * @param url A string containing the URL to which the request is sent.
     * @param data A plain object or string that is sent to the server with the request.
     * @param success A callback function that is executed if the request succeeds. Required if dataType is provided, but can be null in that case.
     * @param dataType The type of data expected from the server. Default: Intelligent Guess (xml, json, script, text, html).
     */
    post(url: string, data?: Object, success?: (data: any, textStatus: string, jqXHR: JQueryXHR) => any, dataType?: string): JQueryXHR;
    /**
     * Load data from the server using a HTTP POST request.
     *
     * @param url A string containing the URL to which the request is sent.
     * @param data A plain object or string that is sent to the server with the request.
     * @param success A callback function that is executed if the request succeeds. Required if dataType is provided, but can be null in that case.
     * @param dataType The type of data expected from the server. Default: Intelligent Guess (xml, json, script, text, html).
     */
    post(url: string, data?: string, success?: (data: any, textStatus: string, jqXHR: JQueryXHR) => any, dataType?: string): JQueryXHR;

    /**
     * A multi-purpose callbacks list object that provides a powerful way to manage callback lists.
     *
     * @param flags An optional list of space-separated flags that change how the callback list behaves.
     */
    Callbacks(flags?: string): JQueryCallback;

    /**
     * Holds or releases the execution of jQuery's ready event.
     *
     * @param hold Indicates whether the ready hold is being requested or released
     */
    holdReady(hold: boolean): void;

    /**
     * Accepts a string containing a CSS selector which is then used to match a set of elements.
     *
     * @param selector A string containing a selector expression
     * @param context A DOM Element, Document, or jQuery to use as context
     */
    (selector: string, context?: Element): JQuery;
    /**
     * Accepts a string containing a CSS selector which is then used to match a set of elements.
     *
     * @param selector A string containing a selector expression
     * @param context A DOM Element, Document, or jQuery to use as context
     */
    (selector: string, context?: JQuery): JQuery;
    /**
     * Accepts a string containing a CSS selector which is then used to match a set of elements.
     *
     * @param element A DOM element to wrap in a jQuery object.
     */
    (element: Element): JQuery;
    /**
     * Accepts a string containing a CSS selector which is then used to match a set of elements.
     *
     * @param elementArray An array containing a set of DOM elements to wrap in a jQuery object.
     */
    (elementArray: Element[]): JQuery;
    /**
     * Accepts a string containing a CSS selector which is then used to match a set of elements.
     *
     * @param object A plain object to wrap in a jQuery object.
     */
    (object: {}): JQuery;
    /**
     * Accepts a string containing a CSS selector which is then used to match a set of elements.
     *
     * @param object An existing jQuery object to clone.
     */
    (object: JQuery): JQuery;
    /**
     * Specify a function to execute when the DOM is fully loaded.
     */
    (): JQuery;

    /**
     * Creates DOM elements on the fly from the provided string of raw HTML.
     *
     * @param html A string of HTML to create on the fly. Note that this parses HTML, not XML.
     * @param ownerDocument A document in which the new elements will be created.
     */
    (html: string, ownerDocument?: Document): JQuery;
    /**
     * Creates DOM elements on the fly from the provided string of raw HTML.
     *
     * @param html A string defining a single, standalone, HTML element (e.g. <div/> or <div></div>).
     * @param attributes An object of attributes, events, and methods to call on the newly-created element.
     */
    (html: string, attributes: Object): JQuery;

    /**
     * Binds a function to be executed when the DOM has finished loading.
     *
     * @param callback A function to execute after the DOM is ready.
     */
    (callback: Function): JQuery;

    /**
     * Relinquish jQuery's control of the $ variable.
     *
     * @param removeAll A Boolean indicating whether to remove all jQuery variables from the global scope (including jQuery itself).
     */
    noConflict(removeAll?: boolean): Object;

    /**
     * Provides a way to execute callback functions based on one or more objects, usually Deferred objects that represent asynchronous events.
     *
     * @param deferreds One or more Deferred objects, or plain JavaScript objects.
     */
    when<T>(...deferreds: JQueryGenericPromise<T>[]): JQueryPromise<T>;
    /**
     * Provides a way to execute callback functions based on one or more objects, usually Deferred objects that represent asynchronous events.
     *
     * @param deferreds One or more Deferred objects, or plain JavaScript objects.
     */
    when<T>(...deferreds: T[]): JQueryPromise<T>;
    /**
     * Provides a way to execute callback functions based on one or more objects, usually Deferred objects that represent asynchronous events.
     *
     * @param deferreds One or more Deferred objects, or plain JavaScript objects.
     */
    when<T>(...deferreds: any[]): JQueryPromise<T>;

    /**
     * Hook directly into jQuery to override how particular CSS properties are retrieved or set, normalize CSS property naming, or create custom properties.
     */
    cssHooks: { [key: string]: any; };
    cssNumber: any;

    /**
     * Store arbitrary data associated with the specified element. Returns the value that was set.
     *
     * @param element The DOM element to associate with the data.
     * @param key A string naming the piece of data to set.
     * @param value The new data value.
     */
    data<T>(element: Element, key: string, value: T): T;
    /**
     * Returns value at named data store for the element, as set by jQuery.data(element, name, value), or the full data store for the element.
     *
     * @param element The DOM element to associate with the data.
     * @param key A string naming the piece of data to set.
     */
    data(element: Element, key: string): any;
    /**
     * Returns value at named data store for the element, as set by jQuery.data(element, name, value), or the full data store for the element.
     *
     * @param element The DOM element to associate with the data.
     */
    data(element: Element): any;

    /**
     * Execute the next function on the queue for the matched element.
     *
     * @param element A DOM element from which to remove and execute a queued function.
     * @param queueName A string containing the name of the queue. Defaults to fx, the standard effects queue.
     */
    dequeue(element: Element, queueName?: string): void;

    /**
     * Determine whether an element has any jQuery data associated with it.
     *
     * @param element A DOM element to be checked for data.
     */
    hasData(element: Element): boolean;

    /**
     * Show the queue of functions to be executed on the matched element.
     *
     * @param element A DOM element to inspect for an attached queue.
     * @param queueName A string containing the name of the queue. Defaults to fx, the standard effects queue.
     */
    queue(element: Element, queueName?: string): any[];
    /**
     * Manipulate the queue of functions to be executed on the matched element.
     *
     * @param element A DOM element where the array of queued functions is attached.
     * @param queueName A string containing the name of the queue. Defaults to fx, the standard effects queue.
     * @param newQueue An array of functions to replace the current queue contents.
     */
    queue(element: Element, queueName: string, newQueue: Function[]): JQuery;
    /**
     * Manipulate the queue of functions to be executed on the matched element.
     *
     * @param element A DOM element on which to add a queued function.
     * @param queueName A string containing the name of the queue. Defaults to fx, the standard effects queue.
     * @param callback The new function to add to the queue.
     */
    queue(element: Element, queueName: string, callback: Function): JQuery;

    /**
     * Remove a previously-stored piece of data.
     *
     * @param element A DOM element from which to remove data.
     * @param name A string naming the piece of data to remove.
     */
    removeData(element: Element, name?: string): JQuery;

    /**
     * A constructor function that returns a chainable utility object with methods to register multiple callbacks into callback queues, invoke callback queues, and relay the success or failure state of any synchronous or asynchronous function.
     *
     * @param beforeStart A function that is called just before the constructor returns.
     */
    Deferred<T>(beforeStart?: (deferred: JQueryDeferred<T>) => any): JQueryDeferred<T>;

    /**
     * Effects
     */
    fx: {
        tick: () => void;
        /**
         * The rate (in milliseconds) at which animations fire.
         */
        interval: number;
        stop: () => void;
        speeds: { slow: number; fast: number; };
        /**
         * Globally disable all animations.
         */
        off: boolean;
        step: any;
    };

    /**
     * Takes a function and returns a new one that will always have a particular context.
     *
     * @param fnction The function whose context will be changed.
     * @param context The object to which the context (this) of the function should be set.
     * @param additionalArguments Any number of arguments to be passed to the function referenced in the function argument.
     */
    proxy(fnction: (...args: any[]) => any, context: Object, ...additionalArguments: any[]): any;
    /**
     * Takes a function and returns a new one that will always have a particular context.
     *
     * @param context The object to which the context (this) of the function should be set.
     * @param name The name of the function whose context will be changed (should be a property of the context object).
     * @param additionalArguments Any number of arguments to be passed to the function named in the name argument.
     */
    proxy(context: Object, name: string, ...additionalArguments: any[]): any;

    Event: JQueryEventConstructor;

    /**
     * Takes a string and throws an exception containing it.
     *
     * @param message The message to send out.
     */
    error(message: any): JQuery;

    expr: any;
    fn: any;  //TODO: Decide how we want to type this

    isReady: boolean;

    // Properties
    support: JQuerySupport;

    /**
     * Check to see if a DOM element is a descendant of another DOM element.
     * 
     * @param container The DOM element that may contain the other element.
     * @param contained The DOM element that may be contained by (a descendant of) the other element.
     */
    contains(container: Element, contained: Element): boolean;

    /**
     * A generic iterator function, which can be used to seamlessly iterate over both objects and arrays. Arrays and array-like objects with a length property (such as a function's arguments object) are iterated by numeric index, from 0 to length-1. Other objects are iterated via their named properties.
     * 
     * @param collection The object or array to iterate over.
     * @param callback The function that will be executed on every object.
     */
    each<T>(
        collection: T[],
        callback: (indexInArray: number, valueOfElement: T) => any
        ): any;

    /**
     * A generic iterator function, which can be used to seamlessly iterate over both objects and arrays. Arrays and array-like objects with a length property (such as a function's arguments object) are iterated by numeric index, from 0 to length-1. Other objects are iterated via their named properties.
     * 
     * @param collection The object or array to iterate over.
     * @param callback The function that will be executed on every object.
     */
    each(
        collection: any,
        callback: (indexInArray: any, valueOfElement: any) => any
        ): any;

    /**
     * Merge the contents of two or more objects together into the first object.
     *
     * @param target An object that will receive the new properties if additional objects are passed in or that will extend the jQuery namespace if it is the sole argument.
     * @param object1 An object containing additional properties to merge in.
     * @param objectN Additional objects containing properties to merge in.
     */
    extend(target: any, object1?: any, ...objectN: any[]): any;
    /**
     * Merge the contents of two or more objects together into the first object.
     *
     * @param deep If true, the merge becomes recursive (aka. deep copy).
     * @param target The object to extend. It will receive the new properties.
     * @param object1 An object containing additional properties to merge in.
     * @param objectN Additional objects containing properties to merge in.
     */
    extend(deep: boolean, target: any, object1?: any, ...objectN: any[]): any;

    /**
     * Execute some JavaScript code globally.
     *
     * @param code The JavaScript code to execute.
     */
    globalEval(code: string): any;

    /**
     * Finds the elements of an array which satisfy a filter function. The original array is not affected.
     *
     * @param array The array to search through.
     * @param func The function to process each item against. The first argument to the function is the item, and the second argument is the index. The function should return a Boolean value.  this will be the global window object.
     * @param invert If "invert" is false, or not provided, then the function returns an array consisting of all elements for which "callback" returns true. If "invert" is true, then the function returns an array consisting of all elements for which "callback" returns false.
     */
    grep<T>(array: T[], func: (elementOfArray: T, indexInArray: number) => boolean, invert?: boolean): T[];

    /**
     * Search for a specified value within an array and return its index (or -1 if not found).
     *
     * @param value The value to search for.
     * @param array An array through which to search.
     * @param fromIndex he index of the array at which to begin the search. The default is 0, which will search the whole array.
     */
    inArray<T>(value: T, array: T[], fromIndex?: number): number;

    /**
     * Determine whether the argument is an array.
     *
     * @param obj Object to test whether or not it is an array.
     */
    isArray(obj: any): boolean;
    /**
     * Check to see if an object is empty (contains no enumerable properties).
     *
     * @param obj The object that will be checked to see if it's empty.
     */
    isEmptyObject(obj: any): boolean;
    /**
     * Determine if the argument passed is a Javascript function object.
     *
     * @param obj Object to test whether or not it is a function.
     */
    isFunction(obj: any): boolean;
    /**
     * Determines whether its argument is a number.
     *
     * @param obj The value to be tested.
     */
    isNumeric(value: any): boolean;
    /**
     * Check to see if an object is a plain object (created using "{}" or "new Object").
     *
     * @param obj The object that will be checked to see if it's a plain object.
     */
    isPlainObject(obj: any): boolean;
    /**
     * Determine whether the argument is a window.
     *
     * @param obj Object to test whether or not it is a window.
     */
    isWindow(obj: any): boolean;
    /**
     * Check to see if a DOM node is within an XML document (or is an XML document).
     *
     * @param node he DOM node that will be checked to see if it's in an XML document.
     */
    isXMLDoc(node: Node): boolean;

    /**
     * Convert an array-like object into a true JavaScript array.
     * 
     * @param obj Any object to turn into a native Array.
     */
    makeArray(obj: any): any[];

    /**
     * Translate all items in an array or object to new array of items.
     * 
     * @param array The Array to translate.
     * @param callback The function to process each item against. The first argument to the function is the array item, the second argument is the index in array The function can return any value. Within the function, this refers to the global (window) object.
     */
    map<T, U>(array: T[], callback: (elementOfArray: T, indexInArray: number) => U): U[];
    /**
     * Translate all items in an array or object to new array of items.
     * 
     * @param arrayOrObject The Array or Object to translate.
     * @param callback The function to process each item against. The first argument to the function is the value; the second argument is the index or key of the array or object property. The function can return any value to add to the array. A returned array will be flattened into the resulting array. Within the function, this refers to the global (window) object.
     */
    map(arrayOrObject: any, callback: (value: any, indexOrKey: any) => any): any;

    /**
     * Merge the contents of two arrays together into the first array.
     * 
     * @param first The first array to merge, the elements of second added.
     * @param second The second array to merge into the first, unaltered.
     */
    merge<T>(first: T[], second: T[]): T[];

    /**
     * An empty function.
     */
    noop(): any;

    /**
     * Return a number representing the current time.
     */
    now(): number;

    /**
     * Takes a well-formed JSON string and returns the resulting JavaScript object.
     * 
     * @param json The JSON string to parse.
     */
    parseJSON(json: string): any;

    /**
     * Parses a string into an XML document.
     *
     * @param data a well-formed XML string to be parsed
     */
    parseXML(data: string): XMLDocument;

    /**
     * Remove the whitespace from the beginning and end of a string.
     * 
     * @param str Remove the whitespace from the beginning and end of a string.
     */
    trim(str: string): string;

    /**
     * Determine the internal JavaScript [[Class]] of an object.
     * 
     * @param obj Object to get the internal JavaScript [[Class]] of.
     */
    type(obj: any): string;

    /**
     * Sorts an array of DOM elements, in place, with the duplicates removed. Note that this only works on arrays of DOM elements, not strings or numbers.
     * 
     * @param array The Array of DOM elements.
     */
    unique(array: Element[]): Element[];

    /**
     * Parses a string into an array of DOM nodes.
     *
     * @param data HTML string to be parsed
     * @param context DOM element to serve as the context in which the HTML fragment will be created
     * @param keepScripts A Boolean indicating whether to include scripts passed in the HTML string
     */
    parseHTML(data: string, context?: HTMLElement, keepScripts?: boolean): any[];

    /**
     * Parses a string into an array of DOM nodes.
     *
     * @param data HTML string to be parsed
     * @param context DOM element to serve as the context in which the HTML fragment will be created
     * @param keepScripts A Boolean indicating whether to include scripts passed in the HTML string
     */
    parseHTML(data: string, context?: Document, keepScripts?: boolean): any[];
}

/**
 * The jQuery instance members
 */
interface JQuery {
    /**
     * Register a handler to be called when Ajax requests complete. This is an AjaxEvent.
     *
     * @param handler The function to be invoked.
     */
    ajaxComplete(handler: (event: JQueryEventObject, XMLHttpRequest: XMLHttpRequest, ajaxOptions: any) => any): JQuery;
    /**
     * Register a handler to be called when Ajax requests complete with an error. This is an Ajax Event.
     *
     * @param handler The function to be invoked.
     */
    ajaxError(handler: (event: JQueryEventObject, jqXHR: JQueryXHR, ajaxSettings: JQueryAjaxSettings, thrownError: any) => any): JQuery;
    /**
     * Attach a function to be executed before an Ajax request is sent. This is an Ajax Event.
     *
     * @param handler The function to be invoked.
     */
    ajaxSend(handler: (event: JQueryEventObject, jqXHR: JQueryXHR, ajaxOptions: JQueryAjaxSettings) => any): JQuery;
    /**
     * Register a handler to be called when the first Ajax request begins. This is an Ajax Event.
     *
     * @param handler The function to be invoked.
     */
    ajaxStart(handler: () => any): JQuery;
    /**
     * Register a handler to be called when all Ajax requests have completed. This is an Ajax Event.
     *
     * @param handler The function to be invoked.
     */
    ajaxStop(handler: () => any): JQuery;
    /**
     * Attach a function to be executed whenever an Ajax request completes successfully. This is an Ajax Event.
     *
     * @param handler The function to be invoked.
     */
    ajaxSuccess(handler: (event: JQueryEventObject, XMLHttpRequest: XMLHttpRequest, ajaxOptions: JQueryAjaxSettings) => any): JQuery;

    /**
     * Load data from the server and place the returned HTML into the matched element.
     *
     * @param url A string containing the URL to which the request is sent.
     * @param data A plain object or string that is sent to the server with the request.
     * @param complete A callback function that is executed when the request completes.
     */
    load(url: string, data?: string, complete?: (responseText: string, textStatus: string, XMLHttpRequest: XMLHttpRequest) => any): JQuery;
    /**
     * Load data from the server and place the returned HTML into the matched element.
     *
     * @param url A string containing the URL to which the request is sent.
     * @param data A plain object or string that is sent to the server with the request.
     * @param complete A callback function that is executed when the request completes.
     */
    load(url: string, data?: Object, complete?: (responseText: string, textStatus: string, XMLHttpRequest: XMLHttpRequest) => any): JQuery;

    /**
     * Encode a set of form elements as a string for submission.
     */
    serialize(): string;
    /**
     * Encode a set of form elements as an array of names and values.
     */
    serializeArray(): Object[];

    /**
     * Adds the specified class(es) to each of the set of matched elements.
     *
     * @param className One or more space-separated classes to be added to the class attribute of each matched element.
     */
    addClass(className: string): JQuery;
    /**
     * Adds the specified class(es) to each of the set of matched elements.
     *
     * @param function A function returning one or more space-separated class names to be added to the existing class name(s). Receives the index position of the element in the set and the existing class name(s) as arguments. Within the function, this refers to the current element in the set.
     */
    addClass(func: (index: number, className: string) => string): JQuery;

    /**
     * Add the previous set of elements on the stack to the current set, optionally filtered by a selector.
     */
    addBack(selector?: string): JQuery;

    /**
     * Get the value of an attribute for the first element in the set of matched elements.
     *
     * @param attributeName The name of the attribute to get.
     */
    attr(attributeName: string): string;
    /**
     * Set one or more attributes for the set of matched elements.
     *
     * @param attributeName The name of the attribute to set.
     * @param value A value to set for the attribute.
     */
    attr(attributeName: string, value: string): JQuery;
    /**
     * Set one or more attributes for the set of matched elements.
     *
     * @param attributeName The name of the attribute to set.
     * @param value A value to set for the attribute.
     */
    attr(attributeName: string, value: number): JQuery;
    /**
     * Set one or more attributes for the set of matched elements.
     *
     * @param attributeName The name of the attribute to set.
     * @param func A function returning the value to set. this is the current element. Receives the index position of the element in the set and the old attribute value as arguments.
     */
    attr(attributeName: string, func: (index: number, attr: any) => any): JQuery;
    /**
     * Set one or more attributes for the set of matched elements.
     *
     * @param attributes An object of attribute-value pairs to set.
     */
    attr(attributes: Object): JQuery;
    
    /**
     * Determine whether any of the matched elements are assigned the given class.
     *
     * @param className The class name to search for.
     */
    hasClass(className: string): boolean;

    /**
     * Get the HTML contents of the first element in the set of matched elements.
     */
    html(): string;
    /**
     * Set the HTML contents of each element in the set of matched elements.
     *
     * @param htmlString A string of HTML to set as the content of each matched element.
     */
    html(htmlString: string): JQuery;
    /**
     * Set the HTML contents of each element in the set of matched elements.
     *
     * @param func A function returning the HTML content to set. Receives the index position of the element in the set and the old HTML value as arguments. jQuery empties the element before calling the function; use the oldhtml argument to reference the previous content. Within the function, this refers to the current element in the set.
     */
    html(func: (index: number, oldhtml: string) => string): JQuery;
    /**
     * Set the HTML contents of each element in the set of matched elements.
     *
     * @param func A function returning the HTML content to set. Receives the index position of the element in the set and the old HTML value as arguments. jQuery empties the element before calling the function; use the oldhtml argument to reference the previous content. Within the function, this refers to the current element in the set.
     */

    /**
     * Get the value of a property for the first element in the set of matched elements.
     *
     * @param propertyName The name of the property to get.
     */
    prop(propertyName: string): any;
    /**
     * Set one or more properties for the set of matched elements.
     *
     * @param propertyName The name of the property to set.
     * @param value A value to set for the property.
     */
    prop(propertyName: string, value: string): JQuery;
    /**
     * Set one or more properties for the set of matched elements.
     *
     * @param propertyName The name of the property to set.
     * @param value A value to set for the property.
     */
    prop(propertyName: string, value: number): JQuery;
    /**
     * Set one or more properties for the set of matched elements.
     *
     * @param propertyName The name of the property to set.
     * @param value A value to set for the property.
     */
    prop(propertyName: string, value: boolean): JQuery;
    /**
     * Set one or more properties for the set of matched elements.
     *
     * @param properties An object of property-value pairs to set.
     */
    prop(properties: Object): JQuery;
    /**
     * Set one or more properties for the set of matched elements.
     *
     * @param propertyName The name of the property to set.
     * @param func A function returning the value to set. Receives the index position of the element in the set and the old property value as arguments. Within the function, the keyword this refers to the current element.
     */
    prop(propertyName: string, func: (index: number, oldPropertyValue: any) => any): JQuery;

    /**
     * Remove an attribute from each element in the set of matched elements.
     *
     * @param attributeName An attribute to remove; as of version 1.7, it can be a space-separated list of attributes.
     */
    removeAttr(attributeName: string): JQuery;

    /**
     * Remove a single class, multiple classes, or all classes from each element in the set of matched elements.
     *
     * @param className One or more space-separated classes to be removed from the class attribute of each matched element.
     */
    removeClass(className?: string): JQuery;
    /**
     * Remove a single class, multiple classes, or all classes from each element in the set of matched elements.
     *
     * @param function A function returning one or more space-separated class names to be removed. Receives the index position of the element in the set and the old class value as arguments.
     */
    removeClass(func: (index: number, className: string) => string): JQuery;

    /**
     * Remove a property for the set of matched elements.
     *
     * @param propertyName The name of the property to remove.
     */
    removeProp(propertyName: string): JQuery;

    /**
     * Add or remove one or more classes from each element in the set of matched elements, depending on either the class's presence or the value of the switch argument.
     *
     * @param className One or more class names (separated by spaces) to be toggled for each element in the matched set.
     * @param swtch A Boolean (not just truthy/falsy) value to determine whether the class should be added or removed.
     */
    toggleClass(className: string, swtch?: boolean): JQuery;
    /**
     * Add or remove one or more classes from each element in the set of matched elements, depending on either the class's presence or the value of the switch argument.
     *
     * @param swtch A boolean value to determine whether the class should be added or removed.
     */
    toggleClass(swtch?: boolean): JQuery;
    /**
     * Add or remove one or more classes from each element in the set of matched elements, depending on either the class's presence or the value of the switch argument.
     *
     * @param func A function that returns class names to be toggled in the class attribute of each element in the matched set. Receives the index position of the element in the set, the old class value, and the switch as arguments.
     * @param swtch A boolean value to determine whether the class should be added or removed.
     */
    toggleClass(func: (index: number, className: string, swtch: boolean) => string, swtch?: boolean): JQuery;

    /**
     * Get the current value of the first element in the set of matched elements.
     */
    val(): any;
    /**
     * Set the value of each element in the set of matched elements.
     *
     * @param value A string of text or an array of strings corresponding to the value of each matched element to set as selected/checked.
     */
    val(value: string): JQuery;
    /**
     * Set the value of each element in the set of matched elements.
     *
     * @param value A string of text or an array of strings corresponding to the value of each matched element to set as selected/checked.
     */
    val(value: string[]): JQuery;
    /**
     * Set the value of each element in the set of matched elements.
     *
     * @param func A function returning the value to set. this is the current element. Receives the index position of the element in the set and the old value as arguments.
     */
    val(func: (index: number, value: string) => string): JQuery;
    /**
     * Set the value of each element in the set of matched elements.
     *
     * @param func A function returning the value to set. this is the current element. Receives the index position of the element in the set and the old value as arguments.
     */
    val(func: (index: number, value: string[]) => string): JQuery;
    /**
     * Set the value of each element in the set of matched elements.
     *
     * @param func A function returning the value to set. this is the current element. Receives the index position of the element in the set and the old value as arguments.
     */
    val(func: (index: number, value: number) => string): JQuery;
    /**
     * Set the value of each element in the set of matched elements.
     *
     * @param func A function returning the value to set. this is the current element. Receives the index position of the element in the set and the old value as arguments.
     */
    val(func: (index: number, value: string) => string[]): JQuery;
    /**
     * Set the value of each element in the set of matched elements.
     *
     * @param func A function returning the value to set. this is the current element. Receives the index position of the element in the set and the old value as arguments.
     */
    val(func: (index: number, value: string[]) => string[]): JQuery;
    /**
     * Set the value of each element in the set of matched elements.
     *
     * @param func A function returning the value to set. this is the current element. Receives the index position of the element in the set and the old value as arguments.
     */
    val(func: (index: number, value: number) => string[]): JQuery;

    /**
     * Get the value of style properties for the first element in the set of matched elements.
     *
     * @param propertyName A CSS property.
     */
    css(propertyName: string): string;
    /**
     * Set one or more CSS properties for the set of matched elements.
     *
     * @param propertyName A CSS property name.
     * @param value A value to set for the property.
     */
    css(propertyName: string, value: string): JQuery;
    /**
     * Set one or more CSS properties for the set of matched elements.
     *
     * @param propertyName A CSS property name.
     * @param value A value to set for the property.
     */
    css(propertyName: string, value: number): JQuery;
    /**
     * Set one or more CSS properties for the set of matched elements.
     *
     * @param propertyName A CSS property name.
     * @param value A value to set for the property.
     */
    css(propertyName: string, value: string[]): JQuery;
    /**
     * Set one or more CSS properties for the set of matched elements.
     *
     * @param propertyName A CSS property name.
     * @param value A value to set for the property.
     */
    css(propertyName: string, value: number[]): JQuery;
    /**
     * Set one or more CSS properties for the set of matched elements.
     *
     * @param propertyName A CSS property name.
     * @param value A function returning the value to set. this is the current element. Receives the index position of the element in the set and the old value as arguments.
     */
    css(propertyName: string, value: (index: number, value: string) => string): JQuery;
    /**
     * Set one or more CSS properties for the set of matched elements.
     *
     * @param propertyName A CSS property name.
     * @param value A function returning the value to set. this is the current element. Receives the index position of the element in the set and the old value as arguments.
     */
    css(propertyName: string, value: (index: number, value: number) => number): JQuery;
    /**
     * Set one or more CSS properties for the set of matched elements.
     *
     * @param properties An object of property-value pairs to set.
     */
    css(properties: Object): JQuery;

    /**
     * Get the current computed height for the first element in the set of matched elements.
     */
    height(): number;
    /**
     * Set the CSS height of every matched element.
     *
     * @param value An integer representing the number of pixels, or an integer with an optional unit of measure appended (as a string).
     */
    height(value: number): JQuery;
    /**
     * Set the CSS height of every matched element.
     *
     * @param value An integer representing the number of pixels, or an integer with an optional unit of measure appended (as a string).
     */
    height(value: string): JQuery;
    /**
     * Set the CSS height of every matched element.
     *
     * @param func A function returning the height to set. Receives the index position of the element in the set and the old height as arguments. Within the function, this refers to the current element in the set.
     */
    height(func: (index: number, height: number) => number): JQuery;
    /**
     * Set the CSS height of every matched element.
     *
     * @param func A function returning the height to set. Receives the index position of the element in the set and the old height as arguments. Within the function, this refers to the current element in the set.
     */
    height(func: (index: number, height: string) => string): JQuery;
    /**
     * Set the CSS height of every matched element.
     *
     * @param func A function returning the height to set. Receives the index position of the element in the set and the old height as arguments. Within the function, this refers to the current element in the set.
     */
    height(func: (index: number, height: string) => number): JQuery;
    /**
     * Set the CSS height of every matched element.
     *
     * @param func A function returning the height to set. Receives the index position of the element in the set and the old height as arguments. Within the function, this refers to the current element in the set.
     */
    height(func: (index: number, height: number) => string): JQuery;

    /**
     * Get the current computed height for the first element in the set of matched elements, including padding but not border.
     */
    innerHeight(): number;

    /**
     * Sets the inner height on elements in the set of matched elements, including padding but not border.
     *
     * @param value An integer representing the number of pixels, or an integer along with an optional unit of measure appended (as a string).
     */
    innerHeight(height: number): JQuery;

    /**
     * Sets the inner height on elements in the set of matched elements, including padding but not border.
     *
     * @param value An integer representing the number of pixels, or an integer along with an optional unit of measure appended (as a string).
     */
    innerHeight(height: string): JQuery;
    
    /**
     * Get the current computed width for the first element in the set of matched elements, including padding but not border.
     */
    innerWidth(): number;

    /**
     * Sets the inner width on elements in the set of matched elements, including padding but not border.
     *
     * @param value An integer representing the number of pixels, or an integer along with an optional unit of measure appended (as a string).
     */
    innerWidth(width: number): JQuery;

    /**
     * Sets the inner width on elements in the set of matched elements, including padding but not border.
     *
     * @param value An integer representing the number of pixels, or an integer along with an optional unit of measure appended (as a string).
     */
    innerWidth(width: string): JQuery;
    
    /**
     * Get the current coordinates of the first element in the set of matched elements, relative to the document.
     */
    offset(): JQueryCoordinates;
    /**
     * An object containing the properties top and left, which are integers indicating the new top and left coordinates for the elements.
     *
     * @param coordinates An object containing the properties top and left, which are integers indicating the new top and left coordinates for the elements.
     */
    offset(coordinates: JQueryCoordinates): JQuery;
    /**
     * An object containing the properties top and left, which are integers indicating the new top and left coordinates for the elements.
     *
     * @param func A function to return the coordinates to set. Receives the index of the element in the collection as the first argument and the current coordinates as the second argument. The function should return an object with the new top and left properties.
     */
    offset(func: (index: number, coords: JQueryCoordinates) => JQueryCoordinates): JQuery;

    /**
     * Get the current computed height for the first element in the set of matched elements, including padding, border, and optionally margin. Returns an integer (without "px") representation of the value or null if called on an empty set of elements.
     *
     * @param includeMargin A Boolean indicating whether to include the element's margin in the calculation.
     */
    outerHeight(includeMargin?: boolean): number;

   /**
    * Sets the outer height on elements in the set of matched elements, including padding and border.
    *
    * @param value An integer representing the number of pixels, or an integer along with an optional unit of measure appended (as a string).
    */
   outerHeight(height: number): JQuery;

    /**
     * Sets the outer height on elements in the set of matched elements, including padding and border.
     *
     * @param value An integer representing the number of pixels, or an integer along with an optional unit of measure appended (as a string).
     */
    outerHeight(height: string): JQuery;
    
    /**
     * Get the current computed width for the first element in the set of matched elements, including padding and border.
     *
     * @param includeMargin A Boolean indicating whether to include the element's margin in the calculation.
     */
    outerWidth(includeMargin?: boolean): number;

    /**
     * Sets the outer width on elements in the set of matched elements, including padding and border.
     *
     * @param value An integer representing the number of pixels, or an integer along with an optional unit of measure appended (as a string).
     */
    outerWidth(width: number): JQuery;

    /**
     * Sets the outer width on elements in the set of matched elements, including padding and border.
     *
     * @param value An integer representing the number of pixels, or an integer along with an optional unit of measure appended (as a string).
     */
    outerWidth(width: string): JQuery;

    /**
     * Get the current coordinates of the first element in the set of matched elements, relative to the offset parent.
     */
    position(): JQueryCoordinates;

    /**
     * Get the current horizontal position of the scroll bar for the first element in the set of matched elements or set the horizontal position of the scroll bar for every matched element.
     */
    scrollLeft(): number;
    /**
     * Set the current horizontal position of the scroll bar for each of the set of matched elements.
     *
     * @param value An integer indicating the new position to set the scroll bar to.
     */
    scrollLeft(value: number): JQuery;

    /**
     * Get the current vertical position of the scroll bar for the first element in the set of matched elements or set the vertical position of the scroll bar for every matched element.
     */
    scrollTop(): number;
    /**
     * Set the current vertical position of the scroll bar for each of the set of matched elements.
     *
     * @param value An integer indicating the new position to set the scroll bar to.
     */
    scrollTop(value: number): JQuery;

    /**
     * Get the current computed width for the first element in the set of matched elements.
     */
    width(): number;
    /**
     * Set the CSS width of each element in the set of matched elements.
     *
     * @param value An integer representing the number of pixels, or an integer along with an optional unit of measure appended (as a string).
     */
    width(value: number): JQuery;
    /**
     * Set the CSS width of each element in the set of matched elements.
     *
     * @param value An integer representing the number of pixels, or an integer along with an optional unit of measure appended (as a string).
     */
    width(value: string): JQuery;
    /**
     * Set the CSS width of each element in the set of matched elements.
     *
     * @param func A function returning the width to set. Receives the index position of the element in the set and the old width as arguments. Within the function, this refers to the current element in the set.
     */
    width(func: (index: number, width: number) => number): JQuery;
    /**
     * Set the CSS width of each element in the set of matched elements.
     *
     * @param func A function returning the width to set. Receives the index position of the element in the set and the old width as arguments. Within the function, this refers to the current element in the set.
     */
    width(func: (index: number, width: string) => string): JQuery;
    /**
     * Set the CSS width of each element in the set of matched elements.
     *
     * @param func A function returning the width to set. Receives the index position of the element in the set and the old width as arguments. Within the function, this refers to the current element in the set.
     */
    width(func: (index: number, width: string) => number): JQuery;
    /**
     * Set the CSS width of each element in the set of matched elements.
     *
     * @param func A function returning the width to set. Receives the index position of the element in the set and the old width as arguments. Within the function, this refers to the current element in the set.
     */
    width(func: (index: number, width: number) => string): JQuery;

    /**
     * Remove from the queue all items that have not yet been run.
     *
     * @param queueName A string containing the name of the queue. Defaults to fx, the standard effects queue.
     */
    clearQueue(queueName?: string): JQuery;

    /**
     * Store arbitrary data associated with the matched elements.
     *
     * @param key A string naming the piece of data to set.
     * @param value The new data value; it can be any Javascript type including Array or Object.
     */
    data(key: string, value: any): JQuery;
    /**
     * Store arbitrary data associated with the matched elements.
     *
     * @param obj An object of key-value pairs of data to update.
     */
    data(obj: { [key: string]: any; }): JQuery;
    /**
     * Return the value at the named data store for the first element in the jQuery collection, as set by data(name, value) or by an HTML5 data-* attribute.
     *
     * @param key Name of the data stored.
     */
    data(key: string): any;
    /**
     * Return the value at the named data store for the first element in the jQuery collection, as set by data(name, value) or by an HTML5 data-* attribute.
     */
    data(): any;

    /**
     * Execute the next function on the queue for the matched elements.
     *
     * @param queueName A string containing the name of the queue. Defaults to fx, the standard effects queue.
     */
    dequeue(queueName?: string): JQuery;

    /**
     * Remove a previously-stored piece of data.
     *
     * @param name A string naming the piece of data to delete or space-separated string naming the pieces of data to delete.
     */
    removeData(name: string): JQuery;
    /**
     * Remove a previously-stored piece of data.
     *
     * @param list An array of strings naming the pieces of data to delete.
     */
    removeData(list: string[]): JQuery;

    /**
     * Return a Promise object to observe when all actions of a certain type bound to the collection, queued or not, have finished.
     *
     * @param type The type of queue that needs to be observed. (default: fx)
     * @param target Object onto which the promise methods have to be attached
     */
    promise(type?: string, target?: Object): JQueryPromise<any>;

    /**
     * Perform a custom animation of a set of CSS properties.
     *
     * @param properties An object of CSS properties and values that the animation will move toward.
     * @param duration A string or number determining how long the animation will run.
     * @param complete A function to call once the animation is complete.
     */
    animate(properties: Object, duration?: string, complete?: Function): JQuery;
    /**
     * Perform a custom animation of a set of CSS properties.
     *
     * @param properties An object of CSS properties and values that the animation will move toward.
     * @param duration A string or number determining how long the animation will run.
     * @param complete A function to call once the animation is complete.
     */
    animate(properties: Object, duration?: number, complete?: Function): JQuery;
    /**
     * Perform a custom animation of a set of CSS properties.
     *
     * @param properties An object of CSS properties and values that the animation will move toward.
     * @param duration A string or number determining how long the animation will run.
     * @param easing A string indicating which easing function to use for the transition. (default: swing)
     * @param complete A function to call once the animation is complete.
     */
    animate(properties: Object, duration?: string, easing?: string, complete?: Function): JQuery;
    /**
     * Perform a custom animation of a set of CSS properties.
     *
     * @param properties An object of CSS properties and values that the animation will move toward.
     * @param duration A string or number determining how long the animation will run.
     * @param easing A string indicating which easing function to use for the transition. (default: swing)
     * @param complete A function to call once the animation is complete.
     */
    animate(properties: Object, duration?: number, easing?: string, complete?: Function): JQuery;
    /**
     * Perform a custom animation of a set of CSS properties.
     *
     * @param properties An object of CSS properties and values that the animation will move toward.
     * @param options A map of additional options to pass to the method.
     */
    animate(properties: Object, options: JQueryAnimationOptions): JQuery;

    /**
     * Set a timer to delay execution of subsequent items in the queue.
     *
     * @param duration An integer indicating the number of milliseconds to delay execution of the next item in the queue.
     * @param queueName A string containing the name of the queue. Defaults to fx, the standard effects queue.
     */
    delay(duration: number, queueName?: string): JQuery;

    /**
     * Display the matched elements by fading them to opaque.
     *
     * @param duration A string or number determining how long the animation will run.
     * @param complete A function to call once the animation is complete.
     */
    fadeIn(duration?: number, complete?: Function): JQuery;
    /**
     * Display the matched elements by fading them to opaque.
     *
     * @param duration A string or number determining how long the animation will run.
     * @param complete A function to call once the animation is complete.
     */
    fadeIn(duration?: string, complete?: Function): JQuery;
    /**
     * Display the matched elements by fading them to opaque.
     *
     * @param duration A string or number determining how long the animation will run.
     * @param easing A string indicating which easing function to use for the transition.
     * @param complete A function to call once the animation is complete.
     */
    fadeIn(duration?: number, easing?: string, complete?: Function): JQuery;
    /**
     * Display the matched elements by fading them to opaque.
     *
     * @param duration A string or number determining how long the animation will run.
     * @param easing A string indicating which easing function to use for the transition.
     * @param complete A function to call once the animation is complete.
     */
    fadeIn(duration?: string, easing?: string, complete?: Function): JQuery;
    /**
     * Display the matched elements by fading them to opaque.
     *
     * @param options A map of additional options to pass to the method.
     */
    fadeIn(options: JQueryAnimationOptions): JQuery;

    /**
     * Hide the matched elements by fading them to transparent.
     *
     * @param duration A string or number determining how long the animation will run.
     * @param complete A function to call once the animation is complete.
     */
    fadeOut(duration?: number, complete?: Function): JQuery;
    /**
     * Hide the matched elements by fading them to transparent.
     *
     * @param duration A string or number determining how long the animation will run.
     * @param complete A function to call once the animation is complete.
     */
    fadeOut(duration?: string, complete?: Function): JQuery;
    /**
     * Hide the matched elements by fading them to transparent.
     *
     * @param duration A string or number determining how long the animation will run.
     * @param easing A string indicating which easing function to use for the transition.
     * @param complete A function to call once the animation is complete.
     */
    fadeOut(duration?: number, easing?: string, complete?: Function): JQuery;
    /**
     * Hide the matched elements by fading them to transparent.
     *
     * @param duration A string or number determining how long the animation will run.
     * @param easing A string indicating which easing function to use for the transition.
     * @param complete A function to call once the animation is complete.
     */
    fadeOut(duration?: string, easing?: string, complete?: Function): JQuery;
    /**
     * Hide the matched elements by fading them to transparent.
     *
     * @param options A map of additional options to pass to the method.
     */
    fadeOut(options: JQueryAnimationOptions): JQuery;

    /**
     * Adjust the opacity of the matched elements.
     *
     * @param duration A string or number determining how long the animation will run.
     * @param opacity A number between 0 and 1 denoting the target opacity.
     * @param complete A function to call once the animation is complete.
     */
    fadeTo(duration: string, opacity: number, complete?: Function): JQuery;
    /**
     * Adjust the opacity of the matched elements.
     *
     * @param duration A string or number determining how long the animation will run.
     * @param opacity A number between 0 and 1 denoting the target opacity.
     * @param complete A function to call once the animation is complete.
     */
    fadeTo(duration: number, opacity: number, complete?: Function): JQuery;
    /**
     * Adjust the opacity of the matched elements.
     *
     * @param duration A string or number determining how long the animation will run.
     * @param opacity A number between 0 and 1 denoting the target opacity.
     * @param easing A string indicating which easing function to use for the transition.
     * @param complete A function to call once the animation is complete.
     */
    fadeTo(duration: string, opacity: number, easing?: string, complete?: Function): JQuery;
    /**
     * Adjust the opacity of the matched elements.
     *
     * @param duration A string or number determining how long the animation will run.
     * @param opacity A number between 0 and 1 denoting the target opacity.
     * @param easing A string indicating which easing function to use for the transition.
     * @param complete A function to call once the animation is complete.
     */
    fadeTo(duration: number, opacity: number, easing?: string, complete?: Function): JQuery;

    /**
     * Display or hide the matched elements by animating their opacity.
     *
     * @param duration A string or number determining how long the animation will run.
     * @param complete A function to call once the animation is complete.
     */
    fadeToggle(duration?: number, complete?: Function): JQuery;
    /**
     * Display or hide the matched elements by animating their opacity.
     *
     * @param duration A string or number determining how long the animation will run.
     * @param complete A function to call once the animation is complete.
     */
    fadeToggle(duration?: string, complete?: Function): JQuery;
    /**
     * Display or hide the matched elements by animating their opacity.
     *
     * @param duration A string or number determining how long the animation will run.
     * @param easing A string indicating which easing function to use for the transition.
     * @param complete A function to call once the animation is complete.
     */
    fadeToggle(duration?: number, easing?: string, complete?: Function): JQuery;
    /**
     * Display or hide the matched elements by animating their opacity.
     *
     * @param duration A string or number determining how long the animation will run.
     * @param easing A string indicating which easing function to use for the transition.
     * @param complete A function to call once the animation is complete.
     */
    fadeToggle(duration?: string, easing?: string, complete?: Function): JQuery;
    /**
     * Display or hide the matched elements by animating their opacity.
     *
     * @param options A map of additional options to pass to the method.
     */
    fadeToggle(options: JQueryAnimationOptions): JQuery;

    /**
     * Stop the currently-running animation, remove all queued animations, and complete all animations for the matched elements.
     *
     * @param queue The name of the queue in which to stop animations.
     */
    finish(queue?: string): JQuery;

    /**
     * Hide the matched elements.
     *
     * @param duration A string or number determining how long the animation will run.
     * @param complete A function to call once the animation is complete.
     */
    hide(duration?: number, complete?: Function): JQuery;
    /**
     * Hide the matched elements.
     *
     * @param duration A string or number determining how long the animation will run.
     * @param complete A function to call once the animation is complete.
     */
    hide(duration?: string, complete?: Function): JQuery;
    /**
     * Hide the matched elements.
     *
     * @param duration A string or number determining how long the animation will run.
     * @param easing A string indicating which easing function to use for the transition.
     * @param complete A function to call once the animation is complete.
     */
    hide(duration?: number, easing?: string, complete?: Function): JQuery;
    /**
     * Hide the matched elements.
     *
     * @param duration A string or number determining how long the animation will run.
     * @param easing A string indicating which easing function to use for the transition.
     * @param complete A function to call once the animation is complete.
     */
    hide(duration?: string, easing?: string, complete?: Function): JQuery;
    /**
     * Hide the matched elements.
     *
     * @param options A map of additional options to pass to the method.
     */
    hide(options: JQueryAnimationOptions): JQuery;

    /**
     * Display the matched elements.
     *
     * @param duration A string or number determining how long the animation will run.
     * @param complete A function to call once the animation is complete.
     */
    show(duration?: number, complete?: Function): JQuery;
    /**
     * Display the matched elements.
     *
     * @param duration A string or number determining how long the animation will run.
     * @param complete A function to call once the animation is complete.
     */
    show(duration?: string, complete?: Function): JQuery;
    /**
     * Display the matched elements.
     *
     * @param duration A string or number determining how long the animation will run.
     * @param easing A string indicating which easing function to use for the transition.
     * @param complete A function to call once the animation is complete.
     */
    show(duration?: number, easing?: string, complete?: Function): JQuery;
    /**
     * Display the matched elements.
     *
     * @param duration A string or number determining how long the animation will run.
     * @param easing A string indicating which easing function to use for the transition.
     * @param complete A function to call once the animation is complete.
     */
    show(duration?: string, easing?: string, complete?: Function): JQuery;
    /**
     * Display the matched elements.
     *
     * @param options A map of additional options to pass to the method.
     */
    show(options: JQueryAnimationOptions): JQuery;

    /**
     * Display the matched elements with a sliding motion.
     *
     * @param duration A string or number determining how long the animation will run.
     * @param complete A function to call once the animation is complete.
     */
    slideDown(duration?: number, complete?: Function): JQuery;
    /**
     * Display the matched elements with a sliding motion.
     *
     * @param duration A string or number determining how long the animation will run.
     * @param complete A function to call once the animation is complete.
     */
    slideDown(duration?: string, complete?: Function): JQuery;
    /**
     * Display the matched elements with a sliding motion.
     *
     * @param duration A string or number determining how long the animation will run.
     * @param easing A string indicating which easing function to use for the transition.
     * @param complete A function to call once the animation is complete.
     */
    slideDown(duration?: number, easing?: string, complete?: Function): JQuery;
    /**
     * Display the matched elements with a sliding motion.
     *
     * @param duration A string or number determining how long the animation will run.
     * @param easing A string indicating which easing function to use for the transition.
     * @param complete A function to call once the animation is complete.
     */
    slideDown(duration?: string, easing?: string, complete?: Function): JQuery;
    /**
     * Display the matched elements with a sliding motion.
     *
     * @param options A map of additional options to pass to the method.
     */
    slideDown(options: JQueryAnimationOptions): JQuery;

    /**
     * Display or hide the matched elements with a sliding motion.
     *
     * @param duration A string or number determining how long the animation will run.
     * @param complete A function to call once the animation is complete.
     */
    slideToggle(duration?: number, complete?: Function): JQuery;
    /**
     * Display or hide the matched elements with a sliding motion.
     *
     * @param duration A string or number determining how long the animation will run.
     * @param complete A function to call once the animation is complete.
     */
    slideToggle(duration?: string, complete?: Function): JQuery;
    /**
     * Display or hide the matched elements with a sliding motion.
     *
     * @param duration A string or number determining how long the animation will run.
     * @param easing A string indicating which easing function to use for the transition.
     * @param complete A function to call once the animation is complete.
     */
    slideToggle(duration?: number, easing?: string, complete?: Function): JQuery;
    /**
     * Display or hide the matched elements with a sliding motion.
     *
     * @param duration A string or number determining how long the animation will run.
     * @param easing A string indicating which easing function to use for the transition.
     * @param complete A function to call once the animation is complete.
     */
    slideToggle(duration?: string, easing?: string, complete?: Function): JQuery;
    /**
     * Display or hide the matched elements with a sliding motion.
     *
     * @param options A map of additional options to pass to the method.
     */
    slideToggle(options: JQueryAnimationOptions): JQuery;

    /**
     * Hide the matched elements with a sliding motion.
     *
     * @param duration A string or number determining how long the animation will run.
     * @param complete A function to call once the animation is complete.
     */
    slideUp(duration?: number, complete?: Function): JQuery;
    /**
     * Hide the matched elements with a sliding motion.
     *
     * @param duration A string or number determining how long the animation will run.
     * @param complete A function to call once the animation is complete.
     */
    slideUp(duration?: string, complete?: Function): JQuery;
    /**
     * Hide the matched elements with a sliding motion.
     *
     * @param duration A string or number determining how long the animation will run.
     * @param easing A string indicating which easing function to use for the transition.
     * @param complete A function to call once the animation is complete.
     */
    slideUp(duration?: number, easing?: string, complete?: Function): JQuery;
    /**
     * Hide the matched elements with a sliding motion.
     *
     * @param duration A string or number determining how long the animation will run.
     * @param easing A string indicating which easing function to use for the transition.
     * @param complete A function to call once the animation is complete.
     */
    slideUp(duration?: string, easing?: string, complete?: Function): JQuery;
    /**
     * Hide the matched elements with a sliding motion.
     *
     * @param options A map of additional options to pass to the method.
     */
    slideUp(options: JQueryAnimationOptions): JQuery;

    /**
     * Stop the currently-running animation on the matched elements.
     *
     * @param clearQueue A Boolean indicating whether to remove queued animation as well. Defaults to false.
     * @param jumpToEnd A Boolean indicating whether to complete the current animation immediately. Defaults to false.
     */
    stop(clearQueue?: boolean, jumpToEnd?: boolean): JQuery;
    /**
     * Stop the currently-running animation on the matched elements.
     *
     * @param queue The name of the queue in which to stop animations.
     * @param clearQueue A Boolean indicating whether to remove queued animation as well. Defaults to false.
     * @param jumpToEnd A Boolean indicating whether to complete the current animation immediately. Defaults to false.
     */
    stop(queue?: string, clearQueue?: boolean, jumpToEnd?: boolean): JQuery;

    /**
     * Display or hide the matched elements.
     *
     * @param duration A string or number determining how long the animation will run.
     * @param complete A function to call once the animation is complete.
     */
    toggle(duration?: number, complete?: Function): JQuery;
    /**
     * Display or hide the matched elements.
     *
     * @param duration A string or number determining how long the animation will run.
     * @param complete A function to call once the animation is complete.
     */
    toggle(duration?: string, complete?: Function): JQuery;
    /**
     * Display or hide the matched elements.
     *
     * @param duration A string or number determining how long the animation will run.
     * @param easing A string indicating which easing function to use for the transition.
     * @param complete A function to call once the animation is complete.
     */
    toggle(duration?: number, easing?: string, complete?: Function): JQuery;
    /**
     * Display or hide the matched elements.
     *
     * @param duration A string or number determining how long the animation will run.
     * @param easing A string indicating which easing function to use for the transition.
     * @param complete A function to call once the animation is complete.
     */
    toggle(duration?: string, easing?: string, complete?: Function): JQuery;
    /**
     * Display or hide the matched elements.
     *
     * @param options A map of additional options to pass to the method.
     */
    toggle(options: JQueryAnimationOptions): JQuery;
    /**
     * Display or hide the matched elements.
     *
     * @param showOrHide A Boolean indicating whether to show or hide the elements.
     */
    toggle(showOrHide: boolean): JQuery;

    /**
     * Attach a handler to an event for the elements.
     * 
     * @param eventType A string containing one or more DOM event types, such as "click" or "submit," or custom event names.
     * @param eventData An object containing data that will be passed to the event handler.
     * @param handler A function to execute each time the event is triggered.
     */
    bind(eventType: string, eventData: any, handler: (eventObject: JQueryEventObject) => any): JQuery;
    /**
     * Attach a handler to an event for the elements.
     * 
     * @param eventType A string containing one or more DOM event types, such as "click" or "submit," or custom event names.
     * @param handler A function to execute each time the event is triggered.
     */
    bind(eventType: string, handler: (eventObject: JQueryEventObject) => any): JQuery;
    /**
     * Attach a handler to an event for the elements.
     * 
     * @param eventType A string containing one or more DOM event types, such as "click" or "submit," or custom event names.
     * @param eventData An object containing data that will be passed to the event handler.
     * @param preventBubble Setting the third argument to false will attach a function that prevents the default action from occurring and stops the event from bubbling. The default is true.
     */
    bind(eventType: string, eventData: any, preventBubble: boolean): JQuery;
    /**
     * Attach a handler to an event for the elements.
     * 
     * @param eventType A string containing one or more DOM event types, such as "click" or "submit," or custom event names.
     * @param preventBubble Setting the third argument to false will attach a function that prevents the default action from occurring and stops the event from bubbling. The default is true.
     */
    bind(eventType: string, preventBubble: boolean): JQuery;
    /**
     * Attach a handler to an event for the elements.
     * 
     * @param events An object containing one or more DOM event types and functions to execute for them.
     */
    bind(events: any): JQuery;

    /**
     * Trigger the "blur" event on an element
     */
    blur(): JQuery;
    /**
     * Bind an event handler to the "blur" JavaScript event
     *
     * @param handler A function to execute each time the event is triggered.
     */
    blur(handler: (eventObject: JQueryEventObject) => any): JQuery;
    /**
     * Bind an event handler to the "blur" JavaScript event
     *
     * @param eventData An object containing data that will be passed to the event handler.
     * @param handler A function to execute each time the event is triggered.
     */
    blur(eventData?: any, handler?: (eventObject: JQueryEventObject) => any): JQuery;

    /**
     * Trigger the "change" event on an element.
     */
    change(): JQuery;
    /**
     * Bind an event handler to the "change" JavaScript event
     *
     * @param handler A function to execute each time the event is triggered.
     */
    change(handler: (eventObject: JQueryEventObject) => any): JQuery;
    /**
     * Bind an event handler to the "change" JavaScript event
     *
     * @param eventData An object containing data that will be passed to the event handler.
     * @param handler A function to execute each time the event is triggered.
     */
    change(eventData?: any, handler?: (eventObject: JQueryEventObject) => any): JQuery;

    /**
     * Trigger the "click" event on an element.
     */
    click(): JQuery;
    /**
     * Bind an event handler to the "click" JavaScript event
     *
     * @param eventData An object containing data that will be passed to the event handler.
     */
    click(handler: (eventObject: JQueryEventObject) => any): JQuery;
    /**
     * Bind an event handler to the "click" JavaScript event
     *
     * @param eventData An object containing data that will be passed to the event handler.
     * @param handler A function to execute each time the event is triggered.
     */
    click(eventData?: any, handler?: (eventObject: JQueryEventObject) => any): JQuery;

    /**
     * Trigger the "dblclick" event on an element.
     */
    dblclick(): JQuery;
    /**
     * Bind an event handler to the "dblclick" JavaScript event
     *
     * @param handler A function to execute each time the event is triggered.
     */
    dblclick(handler: (eventObject: JQueryEventObject) => any): JQuery;
    /**
     * Bind an event handler to the "dblclick" JavaScript event
     *
     * @param eventData An object containing data that will be passed to the event handler.
     * @param handler A function to execute each time the event is triggered.
     */
    dblclick(eventData?: any, handler?: (eventObject: JQueryEventObject) => any): JQuery;

    delegate(selector: any, eventType: string, handler: (eventObject: JQueryEventObject) => any): JQuery;
    delegate(selector: any, eventType: string, eventData: any, handler: (eventObject: JQueryEventObject) => any): JQuery;

    /**
     * Trigger the "focus" event on an element.
     */
    focus(): JQuery;
    /**
     * Bind an event handler to the "focus" JavaScript event
     *
     * @param handler A function to execute each time the event is triggered.
     */
    focus(handler: (eventObject: JQueryEventObject) => any): JQuery;
    /**
     * Bind an event handler to the "focus" JavaScript event
     *
     * @param eventData An object containing data that will be passed to the event handler.
     * @param handler A function to execute each time the event is triggered.
     */
    focus(eventData?: any, handler?: (eventObject: JQueryEventObject) => any): JQuery;

    /**
     * Bind an event handler to the "focusin" JavaScript event
     *
     * @param handler A function to execute each time the event is triggered.
     */
    focusin(handler: (eventObject: JQueryEventObject) => any): JQuery;
    /**
     * Bind an event handler to the "focusin" JavaScript event
     *
     * @param eventData An object containing data that will be passed to the event handler.
     * @param handler A function to execute each time the event is triggered.
     */
    focusin(eventData: Object, handler: (eventObject: JQueryEventObject) => any): JQuery;

    /**
     * Bind an event handler to the "focusout" JavaScript event
     *
     * @param handler A function to execute each time the event is triggered.
     */
    focusout(handler: (eventObject: JQueryEventObject) => any): JQuery;
    /**
     * Bind an event handler to the "focusout" JavaScript event
     *
     * @param eventData An object containing data that will be passed to the event handler.
     * @param handler A function to execute each time the event is triggered.
     */
    focusout(eventData: Object, handler: (eventObject: JQueryEventObject) => any): JQuery;

    /**
     * Bind two handlers to the matched elements, to be executed when the mouse pointer enters and leaves the elements.
     *
     * @param handlerIn A function to execute when the mouse pointer enters the element.
     * @param handlerOut A function to execute when the mouse pointer leaves the element.
     */
    hover(handlerIn: (eventObject: JQueryEventObject) => any, handlerOut: (eventObject: JQueryEventObject) => any): JQuery;
    /**
     * Bind a single handler to the matched elements, to be executed when the mouse pointer enters or leaves the elements.
     *
     * @param handlerInOut A function to execute when the mouse pointer enters or leaves the element.
     */
    hover(handlerInOut: (eventObject: JQueryEventObject) => any): JQuery;

    /**
     * Trigger the "keydown" event on an element.
     */
    keydown(): JQuery;
    /**
     * Bind an event handler to the "keydown" JavaScript event
     *
     * @param handler A function to execute each time the event is triggered.
     */
    keydown(handler: (eventObject: JQueryKeyEventObject) => any): JQuery;
    /**
     * Bind an event handler to the "keydown" JavaScript event
     *
     * @param eventData An object containing data that will be passed to the event handler.
     * @param handler A function to execute each time the event is triggered.
     */
    keydown(eventData?: any, handler?: (eventObject: JQueryKeyEventObject) => any): JQuery;

    /**
     * Trigger the "keypress" event on an element.
     */
    keypress(): JQuery;
    /**
     * Bind an event handler to the "keypress" JavaScript event
     *
     * @param handler A function to execute each time the event is triggered.
     */
    keypress(handler: (eventObject: JQueryKeyEventObject) => any): JQuery;
    /**
     * Bind an event handler to the "keypress" JavaScript event
     *
     * @param eventData An object containing data that will be passed to the event handler.
     * @param handler A function to execute each time the event is triggered.
     */
    keypress(eventData?: any, handler?: (eventObject: JQueryKeyEventObject) => any): JQuery;

    /**
     * Trigger the "keyup" event on an element.
     */
    keyup(): JQuery;
    /**
     * Bind an event handler to the "keyup" JavaScript event
     *
     * @param handler A function to execute each time the event is triggered.
     */
    keyup(handler: (eventObject: JQueryKeyEventObject) => any): JQuery;
    /**
     * Bind an event handler to the "keyup" JavaScript event
     *
     * @param eventData An object containing data that will be passed to the event handler.
     * @param handler A function to execute each time the event is triggered.
     */
    keyup(eventData?: any, handler?: (eventObject: JQueryKeyEventObject) => any): JQuery;

    /**
     * Bind an event handler to the "load" JavaScript event.
     *
     * @param handler A function to execute when the event is triggered.
     */
    load(handler: (eventObject: JQueryEventObject) => any): JQuery;
    /**
     * Bind an event handler to the "load" JavaScript event.
     *
     * @param eventData An object containing data that will be passed to the event handler.
     * @param handler A function to execute when the event is triggered.
     */
    load(eventData?: any, handler?: (eventObject: JQueryEventObject) => any): JQuery;

    /**
     * Trigger the "mousedown" event on an element.
     */
    mousedown(): JQuery;
    /**
     * Bind an event handler to the "mousedown" JavaScript event.
     *
     * @param handler A function to execute when the event is triggered.
     */
    mousedown(handler: (eventObject: JQueryMouseEventObject) => any): JQuery;
    /**
     * Bind an event handler to the "mousedown" JavaScript event.
     *
     * @param eventData An object containing data that will be passed to the event handler.
     * @param handler A function to execute when the event is triggered.
     */
    mousedown(eventData: Object, handler: (eventObject: JQueryMouseEventObject) => any): JQuery;

    /**
     * Trigger the "mouseenter" event on an element.
     */
    mouseenter(): JQuery;
    /**
     * Bind an event handler to be fired when the mouse enters an element.
     *
     * @param handler A function to execute when the event is triggered.
     */
    mouseenter(handler: (eventObject: JQueryMouseEventObject) => any): JQuery;
    /**
     * Bind an event handler to be fired when the mouse enters an element.
     *
     * @param eventData An object containing data that will be passed to the event handler.
     * @param handler A function to execute when the event is triggered.
     */
    mouseenter(eventData: Object, handler: (eventObject: JQueryMouseEventObject) => any): JQuery;

    /**
     * Trigger the "mouseleave" event on an element.
     */
    mouseleave(): JQuery;
    /**
     * Bind an event handler to be fired when the mouse leaves an element.
     *
     * @param handler A function to execute when the event is triggered.
     */
    mouseleave(handler: (eventObject: JQueryMouseEventObject) => any): JQuery;
    /**
     * Bind an event handler to be fired when the mouse leaves an element.
     *
     * @param eventData An object containing data that will be passed to the event handler.
     * @param handler A function to execute when the event is triggered.
     */
    mouseleave(eventData: Object, handler: (eventObject: JQueryMouseEventObject) => any): JQuery;

    /**
     * Trigger the "mousemove" event on an element.
     */
    mousemove(): JQuery;
    /**
     * Bind an event handler to the "mousemove" JavaScript event.
     *
     * @param handler A function to execute when the event is triggered.
     */
    mousemove(handler: (eventObject: JQueryMouseEventObject) => any): JQuery;
    /**
     * Bind an event handler to the "mousemove" JavaScript event.
     *
     * @param eventData An object containing data that will be passed to the event handler.
     * @param handler A function to execute when the event is triggered.
     */
    mousemove(eventData: Object, handler: (eventObject: JQueryMouseEventObject) => any): JQuery;

    /**
     * Trigger the "mouseout" event on an element.
     */
    mouseout(): JQuery;
    /**
     * Bind an event handler to the "mouseout" JavaScript event.
     *
     * @param handler A function to execute when the event is triggered.
     */
    mouseout(handler: (eventObject: JQueryMouseEventObject) => any): JQuery;
    /**
     * Bind an event handler to the "mouseout" JavaScript event.
     *
     * @param eventData An object containing data that will be passed to the event handler.
     * @param handler A function to execute when the event is triggered.
     */
    mouseout(eventData: Object, handler: (eventObject: JQueryMouseEventObject) => any): JQuery;

    /**
     * Trigger the "mouseover" event on an element.
     */
    mouseover(): JQuery;
    /**
     * Bind an event handler to the "mouseover" JavaScript event.
     *
     * @param handler A function to execute when the event is triggered.
     */
    mouseover(handler: (eventObject: JQueryMouseEventObject) => any): JQuery;
    /**
     * Bind an event handler to the "mouseover" JavaScript event.
     *
     * @param eventData An object containing data that will be passed to the event handler.
     * @param handler A function to execute when the event is triggered.
     */
    mouseover(eventData: Object, handler: (eventObject: JQueryMouseEventObject) => any): JQuery;

    /**
     * Trigger the "mouseup" event on an element.
     */
    mouseup(): JQuery;
    /**
     * Bind an event handler to the "mouseup" JavaScript event.
     *
     * @param handler A function to execute when the event is triggered.
     */
    mouseup(handler: (eventObject: JQueryMouseEventObject) => any): JQuery;
    /**
     * Bind an event handler to the "mouseup" JavaScript event.
     *
     * @param eventData An object containing data that will be passed to the event handler.
     * @param handler A function to execute when the event is triggered.
     */
    mouseup(eventData: Object, handler: (eventObject: JQueryMouseEventObject) => any): JQuery;

    /**
     * Remove an event handler.
     */
    off(): JQuery;
    /**
     * Remove an event handler.
     *
     * @param events One or more space-separated event types and optional namespaces, or just namespaces, such as "click", "keydown.myPlugin", or ".myPlugin".
     * @param selector A selector which should match the one originally passed to .on() when attaching event handlers.
     * @param handler A handler function previously attached for the event(s), or the special value false.
     */
    off(events: string, selector?: string, handler?: (eventObject: JQueryEventObject) => any): JQuery;
    /**
     * Remove an event handler.
     *
     * @param events One or more space-separated event types and optional namespaces, or just namespaces, such as "click", "keydown.myPlugin", or ".myPlugin".
     * @param handler A handler function previously attached for the event(s), or the special value false.
     */
    off(events: string, handler: (eventObject: JQueryEventObject) => any): JQuery;
    /**
     * Remove an event handler.
     *
     * @param events An object where the string keys represent one or more space-separated event types and optional namespaces, and the values represent handler functions previously attached for the event(s).
     * @param selector A selector which should match the one originally passed to .on() when attaching event handlers.
     */
    off(events: { [key: string]: any; }, selector?: string): JQuery;

    /**
     * Attach an event handler function for one or more events to the selected elements.
     *
     * @param events One or more space-separated event types and optional namespaces, such as "click" or "keydown.myPlugin".
     * @param handler A function to execute when the event is triggered. The value false is also allowed as a shorthand for a function that simply does return false. Rest parameter args is for optional parameters passed to jQuery.trigger(). Note that the actual parameters on the event handler function must be marked as optional (? syntax).
     */
    on(events: string, handler: (eventObject: JQueryEventObject, ...args: any[]) => any): JQuery;
    /**
     * Attach an event handler function for one or more events to the selected elements.
     *
     * @param events One or more space-separated event types and optional namespaces, such as "click" or "keydown.myPlugin".
     * @param data Data to be passed to the handler in event.data when an event is triggered.
     * @param handler A function to execute when the event is triggered. The value false is also allowed as a shorthand for a function that simply does return false.
    */
    on(events: string, data : any, handler: (eventObject: JQueryEventObject, ...args: any[]) => any): JQuery;
    /**
     * Attach an event handler function for one or more events to the selected elements.
     *
     * @param events One or more space-separated event types and optional namespaces, such as "click" or "keydown.myPlugin".
     * @param selector A selector string to filter the descendants of the selected elements that trigger the event. If the selector is null or omitted, the event is always triggered when it reaches the selected element.
     * @param handler A function to execute when the event is triggered. The value false is also allowed as a shorthand for a function that simply does return false.
     */
    on(events: string, selector: string, handler: (eventObject: JQueryEventObject, ...eventData: any[]) => any): JQuery;
    /**
     * Attach an event handler function for one or more events to the selected elements.
     *
     * @param events One or more space-separated event types and optional namespaces, such as "click" or "keydown.myPlugin".
     * @param selector A selector string to filter the descendants of the selected elements that trigger the event. If the selector is null or omitted, the event is always triggered when it reaches the selected element.
     * @param data Data to be passed to the handler in event.data when an event is triggered.
     * @param handler A function to execute when the event is triggered. The value false is also allowed as a shorthand for a function that simply does return false.
     */
    on(events: string, selector: string, data: any, handler: (eventObject: JQueryEventObject, ...eventData: any[]) => any): JQuery;
    /**
     * Attach an event handler function for one or more events to the selected elements.
     *
     * @param events An object in which the string keys represent one or more space-separated event types and optional namespaces, and the values represent a handler function to be called for the event(s).
     * @param selector A selector string to filter the descendants of the selected elements that will call the handler. If the selector is null or omitted, the handler is always called when it reaches the selected element.
     * @param data Data to be passed to the handler in event.data when an event occurs.
     */
    on(events: { [key: string]: any; }, selector?: any, data?: any): JQuery;

    /**
     * Attach a handler to an event for the elements. The handler is executed at most once per element per event type.
     *
     * @param events A string containing one or more JavaScript event types, such as "click" or "submit," or custom event names.
     * @param handler A function to execute at the time the event is triggered.
     */
    one(events: string, handler: (eventObject: JQueryEventObject) => any): JQuery;
    /**
     * Attach a handler to an event for the elements. The handler is executed at most once per element per event type.
     *
     * @param events A string containing one or more JavaScript event types, such as "click" or "submit," or custom event names.
     * @param data An object containing data that will be passed to the event handler.
     * @param handler A function to execute at the time the event is triggered.
     */
    one(events: string, data: Object, handler: (eventObject: JQueryEventObject) => any): JQuery;

    /**
     * Attach a handler to an event for the elements. The handler is executed at most once per element per event type.
     *
     * @param events One or more space-separated event types and optional namespaces, such as "click" or "keydown.myPlugin".
     * @param selector A selector string to filter the descendants of the selected elements that trigger the event. If the selector is null or omitted, the event is always triggered when it reaches the selected element.
     * @param handler A function to execute when the event is triggered. The value false is also allowed as a shorthand for a function that simply does return false.
     */
    one(events: string, selector: string, handler: (eventObject: JQueryEventObject) => any): JQuery;
    /**
     * Attach a handler to an event for the elements. The handler is executed at most once per element per event type.
     *
     * @param events One or more space-separated event types and optional namespaces, such as "click" or "keydown.myPlugin".
     * @param selector A selector string to filter the descendants of the selected elements that trigger the event. If the selector is null or omitted, the event is always triggered when it reaches the selected element.
     * @param data Data to be passed to the handler in event.data when an event is triggered.
     * @param handler A function to execute when the event is triggered. The value false is also allowed as a shorthand for a function that simply does return false.
     */
    one(events: string, selector: string, data: any, handler: (eventObject: JQueryEventObject) => any): JQuery;

    /**
     * Attach a handler to an event for the elements. The handler is executed at most once per element per event type.
     *
     * @param events An object in which the string keys represent one or more space-separated event types and optional namespaces, and the values represent a handler function to be called for the event(s).
     * @param selector A selector string to filter the descendants of the selected elements that will call the handler. If the selector is null or omitted, the handler is always called when it reaches the selected element.
     * @param data Data to be passed to the handler in event.data when an event occurs.
     */
    one(events: { [key: string]: any; }, selector?: string, data?: any): JQuery;


    /**
     * Specify a function to execute when the DOM is fully loaded.
     *
     * @param handler A function to execute after the DOM is ready.
     */
    ready(handler: Function): JQuery;

    /**
     * Trigger the "resize" event on an element.
     */
    resize(): JQuery;
    /**
     * Bind an event handler to the "resize" JavaScript event.
     *
     * @param handler A function to execute each time the event is triggered.
     */
    resize(handler: (eventObject: JQueryEventObject) => any): JQuery;
    /**
     * Bind an event handler to the "resize" JavaScript event.
     *
     * @param eventData An object containing data that will be passed to the event handler.
     * @param handler A function to execute each time the event is triggered.
     */
    resize(eventData: Object, handler: (eventObject: JQueryEventObject) => any): JQuery;

    /**
     * Trigger the "scroll" event on an element.
     */
    scroll(): JQuery;
    /**
     * Bind an event handler to the "scroll" JavaScript event.
     *
     * @param handler A function to execute each time the event is triggered.
     */
    scroll(handler: (eventObject: JQueryEventObject) => any): JQuery;
    /**
     * Bind an event handler to the "scroll" JavaScript event.
     *
     * @param eventData An object containing data that will be passed to the event handler.
     * @param handler A function to execute each time the event is triggered.
     */
    scroll(eventData: Object, handler: (eventObject: JQueryEventObject) => any): JQuery;

    /**
     * Trigger the "select" event on an element.
     */
    select(): JQuery;
    /**
     * Bind an event handler to the "select" JavaScript event.
     *
     * @param handler A function to execute each time the event is triggered.
     */
    select(handler: (eventObject: JQueryEventObject) => any): JQuery;
    /**
     * Bind an event handler to the "select" JavaScript event.
     *
     * @param eventData An object containing data that will be passed to the event handler.
     * @param handler A function to execute each time the event is triggered.
     */
    select(eventData: Object, handler: (eventObject: JQueryEventObject) => any): JQuery;

    /**
     * Trigger the "submit" event on an element.
     */
    submit(): JQuery;
    /**
     * Bind an event handler to the "submit" JavaScript event
     *
     * @param handler A function to execute each time the event is triggered.
     */
    submit(handler: (eventObject: JQueryEventObject) => any): JQuery;
    /**
     * Bind an event handler to the "submit" JavaScript event
     *
     * @param eventData An object containing data that will be passed to the event handler.
     * @param handler A function to execute each time the event is triggered.
     */
    submit(eventData?: any, handler?: (eventObject: JQueryEventObject) => any): JQuery;

    /**
     * Execute all handlers and behaviors attached to the matched elements for the given event type.
     * 
     * @param eventType A string containing a JavaScript event type, such as click or submit.
     * @param extraParameters Additional parameters to pass along to the event handler.
     */
    trigger(eventType: string, extraParameters?: any[]): JQuery;
    /**
     * Execute all handlers and behaviors attached to the matched elements for the given event type.
     * 
     * @param eventType A string containing a JavaScript event type, such as click or submit.
     * @param extraParameters Additional parameters to pass along to the event handler.
     */
    trigger(eventType: string, extraParameters?: Object): JQuery;
    /**
     * Execute all handlers and behaviors attached to the matched elements for the given event type.
     * 
     * @param event A jQuery.Event object.
     * @param extraParameters Additional parameters to pass along to the event handler.
     */
    trigger(event: JQueryEventObject, extraParameters?: any[]): JQuery;
    /**
     * Execute all handlers and behaviors attached to the matched elements for the given event type.
     * 
     * @param event A jQuery.Event object.
     * @param extraParameters Additional parameters to pass along to the event handler.
     */
    trigger(event: JQueryEventObject, extraParameters?: Object): JQuery;

    /**
     * Execute all handlers attached to an element for an event.
     * 
     * @param eventType A string containing a JavaScript event type, such as click or submit.
     * @param extraParameters An array of additional parameters to pass along to the event handler.
     */
    triggerHandler(eventType: string, ...extraParameters: any[]): Object;

    /**
     * Remove a previously-attached event handler from the elements.
     * 
     * @param eventType A string containing a JavaScript event type, such as click or submit.
     * @param handler The function that is to be no longer executed.
     */
    unbind(eventType?: string, handler?: (eventObject: JQueryEventObject) => any): JQuery;
    /**
     * Remove a previously-attached event handler from the elements.
     * 
     * @param eventType A string containing a JavaScript event type, such as click or submit.
     * @param fls Unbinds the corresponding 'return false' function that was bound using .bind( eventType, false ).
     */
    unbind(eventType: string, fls: boolean): JQuery;
    /**
     * Remove a previously-attached event handler from the elements.
     * 
     * @param evt A JavaScript event object as passed to an event handler.
     */
    unbind(evt: any): JQuery;

    /**
     * Remove a handler from the event for all elements which match the current selector, based upon a specific set of root elements.
     */
    undelegate(): JQuery;
    /**
     * Remove a handler from the event for all elements which match the current selector, based upon a specific set of root elements.
     * 
     * @param selector A selector which will be used to filter the event results.
     * @param eventType A string containing a JavaScript event type, such as "click" or "keydown"
     * @param handler A function to execute at the time the event is triggered.
     */
    undelegate(selector: string, eventType: string, handler?: (eventObject: JQueryEventObject) => any): JQuery;
    /**
     * Remove a handler from the event for all elements which match the current selector, based upon a specific set of root elements.
     * 
     * @param selector A selector which will be used to filter the event results.
     * @param events An object of one or more event types and previously bound functions to unbind from them.
     */
    undelegate(selector: string, events: Object): JQuery;
    /**
     * Remove a handler from the event for all elements which match the current selector, based upon a specific set of root elements.
     * 
     * @param namespace A string containing a namespace to unbind all events from.
     */
    undelegate(namespace: string): JQuery;

    /**
     * Bind an event handler to the "unload" JavaScript event. (DEPRECATED from v1.8)
     * 
     * @param handler A function to execute when the event is triggered.
     */
    unload(handler: (eventObject: JQueryEventObject) => any): JQuery;
    /**
     * Bind an event handler to the "unload" JavaScript event. (DEPRECATED from v1.8)
     * 
     * @param eventData A plain object of data that will be passed to the event handler.
     * @param handler A function to execute when the event is triggered.
     */
    unload(eventData?: any, handler?: (eventObject: JQueryEventObject) => any): JQuery;

    /**
     * The DOM node context originally passed to jQuery(); if none was passed then context will likely be the document. (DEPRECATED from v1.10)
     */
    context: Element;

    jquery: string;

    /**
     * Bind an event handler to the "error" JavaScript event. (DEPRECATED from v1.8)
     * 
     * @param handler A function to execute when the event is triggered.
     */
    error(handler: (eventObject: JQueryEventObject) => any): JQuery;
    /**
     * Bind an event handler to the "error" JavaScript event. (DEPRECATED from v1.8)
     * 
     * @param eventData A plain object of data that will be passed to the event handler.
     * @param handler A function to execute when the event is triggered.
     */
    error(eventData: any, handler: (eventObject: JQueryEventObject) => any): JQuery;

    /**
     * Add a collection of DOM elements onto the jQuery stack.
     * 
     * @param elements An array of elements to push onto the stack and make into a new jQuery object.
     */
    pushStack(elements: any[]): JQuery;
    /**
     * Add a collection of DOM elements onto the jQuery stack.
     * 
     * @param elements An array of elements to push onto the stack and make into a new jQuery object.
     * @param name The name of a jQuery method that generated the array of elements.
     * @param arguments The arguments that were passed in to the jQuery method (for serialization).
     */
    pushStack(elements: any[], name: string, arguments: any[]): JQuery;

    /**
     * Insert content, specified by the parameter, after each element in the set of matched elements.
     * 
     * param content1 HTML string, DOM element, array of elements, or jQuery object to insert after each element in the set of matched elements.
     * param content2 One or more additional DOM elements, arrays of elements, HTML strings, or jQuery objects to insert after each element in the set of matched elements.
     */
    after(content1: JQuery, ...content2: any[]): JQuery;
    /**
     * Insert content, specified by the parameter, after each element in the set of matched elements.
     * 
     * param content1 HTML string, DOM element, array of elements, or jQuery object to insert after each element in the set of matched elements.
     * param content2 One or more additional DOM elements, arrays of elements, HTML strings, or jQuery objects to insert after each element in the set of matched elements.
     */
    after(content1: any[], ...content2: any[]): JQuery;
    /**
     * Insert content, specified by the parameter, after each element in the set of matched elements.
     * 
     * param content1 HTML string, DOM element, array of elements, or jQuery object to insert after each element in the set of matched elements.
     * param content2 One or more additional DOM elements, arrays of elements, HTML strings, or jQuery objects to insert after each element in the set of matched elements.
     */
    after(content1: Element, ...content2: any[]): JQuery;
    /**
     * Insert content, specified by the parameter, after each element in the set of matched elements.
     * 
     * param content1 HTML string, DOM element, array of elements, or jQuery object to insert after each element in the set of matched elements.
     * param content2 One or more additional DOM elements, arrays of elements, HTML strings, or jQuery objects to insert after each element in the set of matched elements.
     */
    after(content1: Text, ...content2: any[]): JQuery;
    /**
     * Insert content, specified by the parameter, after each element in the set of matched elements.
     * 
     * param content1 HTML string, DOM element, array of elements, or jQuery object to insert after each element in the set of matched elements.
     * param content2 One or more additional DOM elements, arrays of elements, HTML strings, or jQuery objects to insert after each element in the set of matched elements.
     */
    after(content1: string, ...content2: any[]): JQuery;
    /**
     * Insert content, specified by the parameter, after each element in the set of matched elements.
     * 
     * param func A function that returns an HTML string, DOM element(s), or jQuery object to insert after each element in the set of matched elements. Receives the index position of the element in the set as an argument. Within the function, this refers to the current element in the set.
     */
    after(func: (index: number) => any): JQuery;

    /**
     * Insert content, specified by the parameter, to the end of each element in the set of matched elements.
     * 
     * param content1 DOM element, array of elements, HTML string, or jQuery object to insert at the end of each element in the set of matched elements.
     * param content2 One or more additional DOM elements, arrays of elements, HTML strings, or jQuery objects to insert at the end of each element in the set of matched elements.
     */
    append(content1: JQuery, ...content2: any[]): JQuery;
    /**
     * Insert content, specified by the parameter, to the end of each element in the set of matched elements.
     * 
     * param content1 DOM element, array of elements, HTML string, or jQuery object to insert at the end of each element in the set of matched elements.
     * param content2 One or more additional DOM elements, arrays of elements, HTML strings, or jQuery objects to insert at the end of each element in the set of matched elements.
     */
    append(content1: any[], ...content2: any[]): JQuery;
    /**
     * Insert content, specified by the parameter, to the end of each element in the set of matched elements.
     * 
     * param content1 DOM element, array of elements, HTML string, or jQuery object to insert at the end of each element in the set of matched elements.
     * param content2 One or more additional DOM elements, arrays of elements, HTML strings, or jQuery objects to insert at the end of each element in the set of matched elements.
     */
    append(content1: Element, ...content2: any[]): JQuery;
    /**
     * Insert content, specified by the parameter, to the end of each element in the set of matched elements.
     * 
     * param content1 DOM element, array of elements, HTML string, or jQuery object to insert at the end of each element in the set of matched elements.
     * param content2 One or more additional DOM elements, arrays of elements, HTML strings, or jQuery objects to insert at the end of each element in the set of matched elements.
     */
    append(content1: Text, ...content2: any[]): JQuery;
    /**
     * Insert content, specified by the parameter, to the end of each element in the set of matched elements.
     * 
     * param content1 DOM element, array of elements, HTML string, or jQuery object to insert at the end of each element in the set of matched elements.
     * param content2 One or more additional DOM elements, arrays of elements, HTML strings, or jQuery objects to insert at the end of each element in the set of matched elements.
     */
    append(content1: string, ...content2: any[]): JQuery;
    /**
     * Insert content, specified by the parameter, to the end of each element in the set of matched elements.
     * 
     * param func A function that returns an HTML string, DOM element(s), or jQuery object to insert at the end of each element in the set of matched elements. Receives the index position of the element in the set and the old HTML value of the element as arguments. Within the function, this refers to the current element in the set.
     */
    append(func: (index: number, html: string) => any): JQuery;

    /**
     * Insert every element in the set of matched elements to the end of the target.
     * 
     * @param target A selector, element, HTML string, array of elements, or jQuery object; the matched set of elements will be inserted at the end of the element(s) specified by this parameter.
     */
    appendTo(target: JQuery): JQuery;
    /**
     * Insert every element in the set of matched elements to the end of the target.
     * 
     * @param target A selector, element, HTML string, array of elements, or jQuery object; the matched set of elements will be inserted at the end of the element(s) specified by this parameter.
     */
    appendTo(target: any[]): JQuery;
    /**
     * Insert every element in the set of matched elements to the end of the target.
     * 
     * @param target A selector, element, HTML string, array of elements, or jQuery object; the matched set of elements will be inserted at the end of the element(s) specified by this parameter.
     */
    appendTo(target: Element): JQuery;
    /**
     * Insert every element in the set of matched elements to the end of the target.
     * 
     * @param target A selector, element, HTML string, array of elements, or jQuery object; the matched set of elements will be inserted at the end of the element(s) specified by this parameter.
     */
    appendTo(target: string): JQuery;

    /**
     * Insert content, specified by the parameter, before each element in the set of matched elements.
     * 
     * param content1 HTML string, DOM element, array of elements, or jQuery object to insert before each element in the set of matched elements.
     * param content2 One or more additional DOM elements, arrays of elements, HTML strings, or jQuery objects to insert before each element in the set of matched elements.
     */
    before(content1: JQuery, ...content2: any[]): JQuery;
    /**
     * Insert content, specified by the parameter, before each element in the set of matched elements.
     * 
     * param content1 HTML string, DOM element, array of elements, or jQuery object to insert before each element in the set of matched elements.
     * param content2 One or more additional DOM elements, arrays of elements, HTML strings, or jQuery objects to insert before each element in the set of matched elements.
     */
    before(content1: any[], ...content2: any[]): JQuery;
    /**
     * Insert content, specified by the parameter, before each element in the set of matched elements.
     * 
     * param content1 HTML string, DOM element, array of elements, or jQuery object to insert before each element in the set of matched elements.
     * param content2 One or more additional DOM elements, arrays of elements, HTML strings, or jQuery objects to insert before each element in the set of matched elements.
     */
    before(content1: Element, ...content2: any[]): JQuery;
    /**
     * Insert content, specified by the parameter, before each element in the set of matched elements.
     * 
     * param content1 HTML string, DOM element, array of elements, or jQuery object to insert before each element in the set of matched elements.
     * param content2 One or more additional DOM elements, arrays of elements, HTML strings, or jQuery objects to insert before each element in the set of matched elements.
     */
    before(content1: Text, ...content2: any[]): JQuery;
    /**
     * Insert content, specified by the parameter, before each element in the set of matched elements.
     * 
     * param content1 HTML string, DOM element, array of elements, or jQuery object to insert before each element in the set of matched elements.
     * param content2 One or more additional DOM elements, arrays of elements, HTML strings, or jQuery objects to insert before each element in the set of matched elements.
     */
    before(content1: string, ...content2: any[]): JQuery;
    /**
     * Insert content, specified by the parameter, before each element in the set of matched elements.
     * 
     * param func A function that returns an HTML string, DOM element(s), or jQuery object to insert before each element in the set of matched elements. Receives the index position of the element in the set as an argument. Within the function, this refers to the current element in the set.
     */
    before(func: (index: number) => any): JQuery;

    /**
     * Create a deep copy of the set of matched elements.
     * 
     * param withDataAndEvents A Boolean indicating whether event handlers and data should be copied along with the elements. The default value is false.
     * param deepWithDataAndEvents A Boolean indicating whether event handlers and data for all children of the cloned element should be copied. By default its value matches the first argument's value (which defaults to false).
     */
    clone(withDataAndEvents?: boolean, deepWithDataAndEvents?: boolean): JQuery;

    /**
     * Remove the set of matched elements from the DOM.
     * 
     * param selector A selector expression that filters the set of matched elements to be removed.
     */
    detach(selector?: string): JQuery;

    /**
     * Remove all child nodes of the set of matched elements from the DOM.
     */
    empty(): JQuery;

    /**
     * Insert every element in the set of matched elements after the target.
     * 
     * param target A selector, element, array of elements, HTML string, or jQuery object; the matched set of elements will be inserted after the element(s) specified by this parameter.
     */
    insertAfter(target: JQuery): JQuery;
    /**
     * Insert every element in the set of matched elements after the target.
     * 
     * param target A selector, element, array of elements, HTML string, or jQuery object; the matched set of elements will be inserted after the element(s) specified by this parameter.
     */
    insertAfter(target: any[]): JQuery;
    /**
     * Insert every element in the set of matched elements after the target.
     * 
     * param target A selector, element, array of elements, HTML string, or jQuery object; the matched set of elements will be inserted after the element(s) specified by this parameter.
     */
    insertAfter(target: Element): JQuery;
    /**
     * Insert every element in the set of matched elements after the target.
     * 
     * param target A selector, element, array of elements, HTML string, or jQuery object; the matched set of elements will be inserted after the element(s) specified by this parameter.
     */
    insertAfter(target: Text): JQuery;
    /**
     * Insert every element in the set of matched elements after the target.
     * 
     * param target A selector, element, array of elements, HTML string, or jQuery object; the matched set of elements will be inserted after the element(s) specified by this parameter.
     */
    insertAfter(target: string): JQuery;

    /**
     * Insert every element in the set of matched elements before the target.
     * 
     * param target A selector, element, array of elements, HTML string, or jQuery object; the matched set of elements will be inserted before the element(s) specified by this parameter.
     */
    insertBefore(target: JQuery): JQuery;
    /**
     * Insert every element in the set of matched elements before the target.
     * 
     * param target A selector, element, array of elements, HTML string, or jQuery object; the matched set of elements will be inserted before the element(s) specified by this parameter.
     */
    insertBefore(target: any[]): JQuery;
    /**
     * Insert every element in the set of matched elements before the target.
     * 
     * param target A selector, element, array of elements, HTML string, or jQuery object; the matched set of elements will be inserted before the element(s) specified by this parameter.
     */
    insertBefore(target: Element): JQuery;
    /**
     * Insert every element in the set of matched elements before the target.
     * 
     * param target A selector, element, array of elements, HTML string, or jQuery object; the matched set of elements will be inserted before the element(s) specified by this parameter.
     */
    insertBefore(target: Text): JQuery;
    /**
     * Insert every element in the set of matched elements before the target.
     * 
     * param target A selector, element, array of elements, HTML string, or jQuery object; the matched set of elements will be inserted before the element(s) specified by this parameter.
     */
    insertBefore(target: string): JQuery;

    /**
     * Insert content, specified by the parameter, to the beginning of each element in the set of matched elements.
     * 
     * param content1 DOM element, array of elements, HTML string, or jQuery object to insert at the beginning of each element in the set of matched elements.
     * param content2 One or more additional DOM elements, arrays of elements, HTML strings, or jQuery objects to insert at the beginning of each element in the set of matched elements.
     */
    prepend(content1: JQuery, ...content2: any[]): JQuery;
    /**
     * Insert content, specified by the parameter, to the beginning of each element in the set of matched elements.
     * 
     * param content1 DOM element, array of elements, HTML string, or jQuery object to insert at the beginning of each element in the set of matched elements.
     * param content2 One or more additional DOM elements, arrays of elements, HTML strings, or jQuery objects to insert at the beginning of each element in the set of matched elements.
     */
    prepend(content1: any[], ...content2: any[]): JQuery;
    /**
     * Insert content, specified by the parameter, to the beginning of each element in the set of matched elements.
     * 
     * param content1 DOM element, array of elements, HTML string, or jQuery object to insert at the beginning of each element in the set of matched elements.
     * param content2 One or more additional DOM elements, arrays of elements, HTML strings, or jQuery objects to insert at the beginning of each element in the set of matched elements.
     */
    prepend(content1: Element, ...content2: any[]): JQuery;
    /**
     * Insert content, specified by the parameter, to the beginning of each element in the set of matched elements.
     * 
     * param content1 DOM element, array of elements, HTML string, or jQuery object to insert at the beginning of each element in the set of matched elements.
     * param content2 One or more additional DOM elements, arrays of elements, HTML strings, or jQuery objects to insert at the beginning of each element in the set of matched elements.
     */
    prepend(content1: Text, ...content2: any[]): JQuery;
    /**
     * Insert content, specified by the parameter, to the beginning of each element in the set of matched elements.
     * 
     * param content1 DOM element, array of elements, HTML string, or jQuery object to insert at the beginning of each element in the set of matched elements.
     * param content2 One or more additional DOM elements, arrays of elements, HTML strings, or jQuery objects to insert at the beginning of each element in the set of matched elements.
     */
    prepend(content1: string, ...content2: any[]): JQuery;
    /**
     * Insert content, specified by the parameter, to the beginning of each element in the set of matched elements.
     * 
     * param func A function that returns an HTML string, DOM element(s), or jQuery object to insert at the beginning of each element in the set of matched elements. Receives the index position of the element in the set and the old HTML value of the element as arguments. Within the function, this refers to the current element in the set.
     */
    prepend(func: (index: number, html: string) => any): JQuery;

    /**
     * Insert every element in the set of matched elements to the beginning of the target.
     * 
     * @param target A selector, element, HTML string, array of elements, or jQuery object; the matched set of elements will be inserted at the beginning of the element(s) specified by this parameter.
     */
    prependTo(target: JQuery): JQuery;
    /**
     * Insert every element in the set of matched elements to the beginning of the target.
     * 
     * @param target A selector, element, HTML string, array of elements, or jQuery object; the matched set of elements will be inserted at the beginning of the element(s) specified by this parameter.
     */
    prependTo(target: any[]): JQuery;
    /**
     * Insert every element in the set of matched elements to the beginning of the target.
     * 
     * @param target A selector, element, HTML string, array of elements, or jQuery object; the matched set of elements will be inserted at the beginning of the element(s) specified by this parameter.
     */
    prependTo(target: Element): JQuery;
    /**
     * Insert every element in the set of matched elements to the beginning of the target.
     * 
     * @param target A selector, element, HTML string, array of elements, or jQuery object; the matched set of elements will be inserted at the beginning of the element(s) specified by this parameter.
     */
    prependTo(target: string): JQuery;

    /**
     * Remove the set of matched elements from the DOM.
     * 
     * @param selector A selector expression that filters the set of matched elements to be removed.
     */
    remove(selector?: string): JQuery;

    /**
     * Replace each target element with the set of matched elements.
     * 
     * @param target A selector string, jQuery object, DOM element, or array of elements indicating which element(s) to replace.
     */
    replaceAll(target: JQuery): JQuery;
    /**
     * Replace each target element with the set of matched elements.
     * 
     * @param target A selector string, jQuery object, DOM element, or array of elements indicating which element(s) to replace.
     */
    replaceAll(target: any[]): JQuery;
    /**
     * Replace each target element with the set of matched elements.
     * 
     * @param target A selector string, jQuery object, DOM element, or array of elements indicating which element(s) to replace.
     */
    replaceAll(target: Element): JQuery;
    /**
     * Replace each target element with the set of matched elements.
     * 
     * @param target A selector string, jQuery object, DOM element, or array of elements indicating which element(s) to replace.
     */
    replaceAll(target: string): JQuery;

    /**
     * Replace each element in the set of matched elements with the provided new content and return the set of elements that was removed.
     * 
     * param newContent The content to insert. May be an HTML string, DOM element, array of DOM elements, or jQuery object.
     */
    replaceWith(newContent: JQuery): JQuery;
    /**
     * Replace each element in the set of matched elements with the provided new content and return the set of elements that was removed.
     * 
     * param newContent The content to insert. May be an HTML string, DOM element, array of DOM elements, or jQuery object.
     */
    replaceWith(newContent: any[]): JQuery;
    /**
     * Replace each element in the set of matched elements with the provided new content and return the set of elements that was removed.
     * 
     * param newContent The content to insert. May be an HTML string, DOM element, array of DOM elements, or jQuery object.
     */
    replaceWith(newContent: Element): JQuery;
    /**
     * Replace each element in the set of matched elements with the provided new content and return the set of elements that was removed.
     * 
     * param newContent The content to insert. May be an HTML string, DOM element, array of DOM elements, or jQuery object.
     */
    replaceWith(newContent: Text): JQuery;
    /**
     * Replace each element in the set of matched elements with the provided new content and return the set of elements that was removed.
     * 
     * param newContent The content to insert. May be an HTML string, DOM element, array of DOM elements, or jQuery object.
     */
    replaceWith(newContent: string): JQuery;
    /**
     * Replace each element in the set of matched elements with the provided new content and return the set of elements that was removed.
     * 
     * param func A function that returns content with which to replace the set of matched elements.
     */
    replaceWith(func: () => any): JQuery;

    /**
     * Get the combined text contents of each element in the set of matched elements, including their descendants.
     */
    text(): string;
    /**
     * Set the content of each element in the set of matched elements to the specified text.
     * 
     * @param text The text to set as the content of each matched element.
     */
    text(text: string): JQuery;
    /**
     * Set the content of each element in the set of matched elements to the specified text.
     * 
     * @param text The text to set as the content of each matched element.
     */
    text(text: number): JQuery;
    /**
     * Set the content of each element in the set of matched elements to the specified text.
     * 
     * @param text The text to set as the content of each matched element.
     */
    text(text: boolean): JQuery;
    /**
     * Set the content of each element in the set of matched elements to the specified text.
     * 
     * @param func A function returning the text content to set. Receives the index position of the element in the set and the old text value as arguments.
     */
    text(func: (index: number, text: string) => string): JQuery;

    /**
     * Retrieve all the elements contained in the jQuery set, as an array.
     */
    toArray(): any[];

    /**
     * Remove the parents of the set of matched elements from the DOM, leaving the matched elements in their place.
     */
    unwrap(): JQuery;

    /**
     * Wrap an HTML structure around each element in the set of matched elements.
     * 
     * @param wrappingElement A selector, element, HTML string, or jQuery object specifying the structure to wrap around the matched elements.
     */
    wrap(wrappingElement: JQuery): JQuery;
    /**
     * Wrap an HTML structure around each element in the set of matched elements.
     * 
     * @param wrappingElement A selector, element, HTML string, or jQuery object specifying the structure to wrap around the matched elements.
     */
    wrap(wrappingElement: Element): JQuery;
    /**
     * Wrap an HTML structure around each element in the set of matched elements.
     * 
     * @param wrappingElement A selector, element, HTML string, or jQuery object specifying the structure to wrap around the matched elements.
     */
    wrap(wrappingElement: string): JQuery;
    /**
     * Wrap an HTML structure around each element in the set of matched elements.
     * 
     * @param func A callback function returning the HTML content or jQuery object to wrap around the matched elements. Receives the index position of the element in the set as an argument. Within the function, this refers to the current element in the set.
     */
    wrap(func: (index: number) => any): JQuery;

    /**
     * Wrap an HTML structure around all elements in the set of matched elements.
     * 
     * @param wrappingElement A selector, element, HTML string, or jQuery object specifying the structure to wrap around the matched elements.
     */
    wrapAll(wrappingElement: JQuery): JQuery;
    /**
     * Wrap an HTML structure around all elements in the set of matched elements.
     * 
     * @param wrappingElement A selector, element, HTML string, or jQuery object specifying the structure to wrap around the matched elements.
     */
    wrapAll(wrappingElement: Element): JQuery;
    /**
     * Wrap an HTML structure around all elements in the set of matched elements.
     * 
     * @param wrappingElement A selector, element, HTML string, or jQuery object specifying the structure to wrap around the matched elements.
     */
    wrapAll(wrappingElement: string): JQuery;

    /**
     * Wrap an HTML structure around the content of each element in the set of matched elements.
     * 
     * @param wrappingElement An HTML snippet, selector expression, jQuery object, or DOM element specifying the structure to wrap around the content of the matched elements.
     */
    wrapInner(wrappingElement: JQuery): JQuery;
    /**
     * Wrap an HTML structure around the content of each element in the set of matched elements.
     * 
     * @param wrappingElement An HTML snippet, selector expression, jQuery object, or DOM element specifying the structure to wrap around the content of the matched elements.
     */
    wrapInner(wrappingElement: Element): JQuery;
    /**
     * Wrap an HTML structure around the content of each element in the set of matched elements.
     * 
     * @param wrappingElement An HTML snippet, selector expression, jQuery object, or DOM element specifying the structure to wrap around the content of the matched elements.
     */
    wrapInner(wrappingElement: string): JQuery;
    /**
     * Wrap an HTML structure around the content of each element in the set of matched elements.
     * 
     * @param func A callback function which generates a structure to wrap around the content of the matched elements. Receives the index position of the element in the set as an argument. Within the function, this refers to the current element in the set.
     */
    wrapInner(func: (index: number) => any): JQuery;

    /**
     * Iterate over a jQuery object, executing a function for each matched element.
     * 
     * @param func A function to execute for each matched element.
     */
    each(func: (index: number, elem: Element) => any): JQuery;

    /**
     * Retrieve one of the elements matched by the jQuery object.
     * 
     * @param index A zero-based integer indicating which element to retrieve.
     */
    get(index: number): HTMLElement;
    /**
     * Retrieve the elements matched by the jQuery object.
     */
    get(): any[];

    /**
     * Search for a given element from among the matched elements.
     */
    index(): number;
    /**
     * Search for a given element from among the matched elements.
     * 
     * @param selector A selector representing a jQuery collection in which to look for an element.
     */
    index(selector: string): number;
    /**
     * Search for a given element from among the matched elements.
     * 
     * @param element The DOM element or first element within the jQuery object to look for.
     */
    index(element: JQuery): number;
    /**
     * Search for a given element from among the matched elements.
     * 
     * @param element The DOM element or first element within the jQuery object to look for.
     */
    index(element: Element): number;

    /**
     * The number of elements in the jQuery object.
     */
    length: number;
    /**
     * A selector representing selector passed to jQuery(), if any, when creating the original set.
     * version deprecated: 1.7, removed: 1.9
     */
    selector: string;
    [index: string]: any;
    [index: number]: HTMLElement;

    /**
     * Add elements to the set of matched elements.
     * 
     * @param selector A string representing a selector expression to find additional elements to add to the set of matched elements.
     * @param context The point in the document at which the selector should begin matching; similar to the context argument of the $(selector, context) method.
     */
    add(selector: string, context?: Element): JQuery;
    /**
     * Add elements to the set of matched elements.
     * 
     * @param elements One or more elements to add to the set of matched elements.
     */
    add(...elements: Element[]): JQuery;
    /**
     * Add elements to the set of matched elements.
     * 
     * @param html An HTML fragment to add to the set of matched elements.
     */
    add(html: string): JQuery;
    /**
     * Add elements to the set of matched elements.
     * 
     * @param obj An existing jQuery object to add to the set of matched elements.
     */
    add(obj: JQuery): JQuery;

    /**
     * Get the children of each element in the set of matched elements, optionally filtered by a selector.
     * 
     * @param selector A string containing a selector expression to match elements against.
     */
    children(selector?: string): JQuery;

    /**
     * For each element in the set, get the first element that matches the selector by testing the element itself and traversing up through its ancestors in the DOM tree.
     * 
     * @param selector A string containing a selector expression to match elements against.
     */
    closest(selector: string): JQuery;
    /**
     * For each element in the set, get the first element that matches the selector by testing the element itself and traversing up through its ancestors in the DOM tree.
     * 
     * @param selector A string containing a selector expression to match elements against.
     * @param context A DOM element within which a matching element may be found. If no context is passed in then the context of the jQuery set will be used instead.
     */
    closest(selector: string, context?: Element): JQuery;
    /**
     * For each element in the set, get the first element that matches the selector by testing the element itself and traversing up through its ancestors in the DOM tree.
     * 
     * @param obj A jQuery object to match elements against.
     */
    closest(obj: JQuery): JQuery;
    /**
     * For each element in the set, get the first element that matches the selector by testing the element itself and traversing up through its ancestors in the DOM tree.
     * 
     * @param element An element to match elements against.
     */
    closest(element: Element): JQuery;

    /**
     * Get an array of all the elements and selectors matched against the current element up through the DOM tree.
     * 
     * @param selectors An array or string containing a selector expression to match elements against (can also be a jQuery object).
     * @param context A DOM element within which a matching element may be found. If no context is passed in then the context of the jQuery set will be used instead.
     */
    closest(selectors: any, context?: Element): any[];

    /**
     * Get the children of each element in the set of matched elements, including text and comment nodes.
     */
    contents(): JQuery;

    /**
     * End the most recent filtering operation in the current chain and return the set of matched elements to its previous state.
     */
    end(): JQuery;

    /**
     * Reduce the set of matched elements to the one at the specified index.
     * 
     * @param index An integer indicating the 0-based position of the element. OR An integer indicating the position of the element, counting backwards from the last element in the set.
     *  
     */
    eq(index: number): JQuery;

    /**
     * Reduce the set of matched elements to those that match the selector or pass the function's test.
     * 
     * @param selector A string containing a selector expression to match the current set of elements against.
     */
    filter(selector: string): JQuery;
    /**
     * Reduce the set of matched elements to those that match the selector or pass the function's test.
     * 
     * @param func A function used as a test for each element in the set. this is the current DOM element.
     */
    filter(func: (index: number) => any): JQuery;
    /**
     * Reduce the set of matched elements to those that match the selector or pass the function's test.
     * 
     * @param element An element to match the current set of elements against.
     */
    filter(element: Element): JQuery;
    /**
     * Reduce the set of matched elements to those that match the selector or pass the function's test.
     * 
     * @param obj An existing jQuery object to match the current set of elements against.
     */
    filter(obj: JQuery): JQuery;

    /**
     * Get the descendants of each element in the current set of matched elements, filtered by a selector, jQuery object, or element.
     * 
     * @param selector A string containing a selector expression to match elements against.
     */
    find(selector: string): JQuery;
    /**
     * Get the descendants of each element in the current set of matched elements, filtered by a selector, jQuery object, or element.
     * 
     * @param element An element to match elements against.
     */
    find(element: Element): JQuery;
    /**
     * Get the descendants of each element in the current set of matched elements, filtered by a selector, jQuery object, or element.
     * 
     * @param obj A jQuery object to match elements against.
     */
    find(obj: JQuery): JQuery;

    /**
     * Reduce the set of matched elements to the first in the set.
     */
    first(): JQuery;

    /**
     * Reduce the set of matched elements to those that have a descendant that matches the selector or DOM element.
     * 
     * @param selector A string containing a selector expression to match elements against.
     */
    has(selector: string): JQuery;
    /**
     * Reduce the set of matched elements to those that have a descendant that matches the selector or DOM element.
     * 
     * @param contained A DOM element to match elements against.
     */
    has(contained: Element): JQuery;

    /**
     * Check the current matched set of elements against a selector, element, or jQuery object and return true if at least one of these elements matches the given arguments.
     * 
     * @param selector A string containing a selector expression to match elements against.
     */
    is(selector: string): boolean;
    /**
     * Check the current matched set of elements against a selector, element, or jQuery object and return true if at least one of these elements matches the given arguments.
     * 
     * @param func A function used as a test for the set of elements. It accepts one argument, index, which is the element's index in the jQuery collection.Within the function, this refers to the current DOM element.
     */
    is(func: (index: number) => any): boolean;
    /**
     * Check the current matched set of elements against a selector, element, or jQuery object and return true if at least one of these elements matches the given arguments.
     * 
     * @param obj An existing jQuery object to match the current set of elements against.
     */
    is(obj: JQuery): boolean;
    /**
     * Check the current matched set of elements against a selector, element, or jQuery object and return true if at least one of these elements matches the given arguments.
     * 
     * @param elements One or more elements to match the current set of elements against.
     */
    is(elements: any): boolean;

    /**
     * Reduce the set of matched elements to the final one in the set.
     */
    last(): JQuery;

    /**
     * Pass each element in the current matched set through a function, producing a new jQuery object containing the return values.
     * 
     * @param callback A function object that will be invoked for each element in the current set.
     */
    map(callback: (index: number, domElement: Element) => any): JQuery;

    /**
     * Get the immediately following sibling of each element in the set of matched elements. If a selector is provided, it retrieves the next sibling only if it matches that selector.
     * 
     * @param selector A string containing a selector expression to match elements against.
     */
    next(selector?: string): JQuery;

    /**
     * Get all following siblings of each element in the set of matched elements, optionally filtered by a selector.
     * 
     * @param selector A string containing a selector expression to match elements against.
     */
    nextAll(selector?: string): JQuery;

    /**
     * Get all following siblings of each element up to but not including the element matched by the selector, DOM node, or jQuery object passed.
     * 
     * @param selector A string containing a selector expression to indicate where to stop matching following sibling elements.
     * @param filter A string containing a selector expression to match elements against.
     */
    nextUntil(selector?: string, filter?: string): JQuery;
    /**
     * Get all following siblings of each element up to but not including the element matched by the selector, DOM node, or jQuery object passed.
     * 
     * @param element A DOM node or jQuery object indicating where to stop matching following sibling elements.
     * @param filter A string containing a selector expression to match elements against.
     */
    nextUntil(element?: Element, filter?: string): JQuery;
    /**
     * Get all following siblings of each element up to but not including the element matched by the selector, DOM node, or jQuery object passed.
     * 
     * @param obj A DOM node or jQuery object indicating where to stop matching following sibling elements.
     * @param filter A string containing a selector expression to match elements against.
     */
    nextUntil(obj?: JQuery, filter?: string): JQuery;

    /**
     * Remove elements from the set of matched elements.
     * 
     * @param selector A string containing a selector expression to match elements against.
     */
    not(selector: string): JQuery;
    /**
     * Remove elements from the set of matched elements.
     * 
     * @param func A function used as a test for each element in the set. this is the current DOM element.
     */
    not(func: (index: number) => any): JQuery;
    /**
     * Remove elements from the set of matched elements.
     * 
     * @param elements One or more DOM elements to remove from the matched set.
     */
    not(...elements: Element[]): JQuery;
    /**
     * Remove elements from the set of matched elements.
     * 
     * @param obj An existing jQuery object to match the current set of elements against.
     */
    not(obj: JQuery): JQuery;

    /**
     * Get the closest ancestor element that is positioned.
     */
    offsetParent(): JQuery;

    /**
     * Get the parent of each element in the current set of matched elements, optionally filtered by a selector.
     * 
     * @param selector A string containing a selector expression to match elements against.
     */
    parent(selector?: string): JQuery;

    /**
     * Get the ancestors of each element in the current set of matched elements, optionally filtered by a selector.
     * 
     * @param selector A string containing a selector expression to match elements against.
     */
    parents(selector?: string): JQuery;

    /**
     * Get the ancestors of each element in the current set of matched elements, up to but not including the element matched by the selector, DOM node, or jQuery object.
     * 
     * @param selector A string containing a selector expression to indicate where to stop matching ancestor elements.
     * @param filter A string containing a selector expression to match elements against.
     */
    parentsUntil(selector?: string, filter?: string): JQuery;
    /**
     * Get the ancestors of each element in the current set of matched elements, up to but not including the element matched by the selector, DOM node, or jQuery object.
     * 
     * @param element A DOM node or jQuery object indicating where to stop matching ancestor elements.
     * @param filter A string containing a selector expression to match elements against.
     */
    parentsUntil(element?: Element, filter?: string): JQuery;
    /**
     * Get the ancestors of each element in the current set of matched elements, up to but not including the element matched by the selector, DOM node, or jQuery object.
     * 
     * @param obj A DOM node or jQuery object indicating where to stop matching ancestor elements.
     * @param filter A string containing a selector expression to match elements against.
     */
    parentsUntil(obj?: JQuery, filter?: string): JQuery;

    /**
     * Get the immediately preceding sibling of each element in the set of matched elements, optionally filtered by a selector.
     * 
     * @param selector A string containing a selector expression to match elements against.
     */
    prev(selector?: string): JQuery;

    /**
     * Get all preceding siblings of each element in the set of matched elements, optionally filtered by a selector.
     * 
     * @param selector A string containing a selector expression to match elements against.
     */
    prevAll(selector?: string): JQuery;

    /**
     * Get all preceding siblings of each element up to but not including the element matched by the selector, DOM node, or jQuery object.
     * 
     * @param selector A string containing a selector expression to indicate where to stop matching preceding sibling elements.
     * @param filter A string containing a selector expression to match elements against.
     */
    prevUntil(selector?: string, filter?: string): JQuery;
    /**
     * Get all preceding siblings of each element up to but not including the element matched by the selector, DOM node, or jQuery object.
     * 
     * @param element A DOM node or jQuery object indicating where to stop matching preceding sibling elements.
     * @param filter A string containing a selector expression to match elements against.
     */
    prevUntil(element?: Element, filter?: string): JQuery;
    /**
     * Get all preceding siblings of each element up to but not including the element matched by the selector, DOM node, or jQuery object.
     * 
     * @param obj A DOM node or jQuery object indicating where to stop matching preceding sibling elements.
     * @param filter A string containing a selector expression to match elements against.
     */
    prevUntil(obj?: JQuery, filter?: string): JQuery;

    /**
     * Get the siblings of each element in the set of matched elements, optionally filtered by a selector.
     * 
     * @param selector A string containing a selector expression to match elements against.
     */
    siblings(selector?: string): JQuery;

    /**
     * Reduce the set of matched elements to a subset specified by a range of indices.
     * 
     * @param start An integer indicating the 0-based position at which the elements begin to be selected. If negative, it indicates an offset from the end of the set.
     * @param end An integer indicating the 0-based position at which the elements stop being selected. If negative, it indicates an offset from the end of the set. If omitted, the range continues until the end of the set.
     */
    slice(start: number, end?: number): JQuery;

    /**
     * Show the queue of functions to be executed on the matched elements.
     * 
     * @param queueName A string containing the name of the queue. Defaults to fx, the standard effects queue.
     */
    queue(queueName?: string): any[];
    /**
     * Manipulate the queue of functions to be executed, once for each matched element.
     * 
     * @param newQueue An array of functions to replace the current queue contents.
     */
    queue(newQueue: Function[]): JQuery;
    /**
     * Manipulate the queue of functions to be executed, once for each matched element.
     * 
     * @param callback The new function to add to the queue, with a function to call that will dequeue the next item.
     */
    queue(callback: Function): JQuery;
    /**
     * Manipulate the queue of functions to be executed, once for each matched element.
     * 
     * @param queueName A string containing the name of the queue. Defaults to fx, the standard effects queue.
     * @param newQueue An array of functions to replace the current queue contents.
     */
    queue(queueName: string, newQueue: Function[]): JQuery;
    /**
     * Manipulate the queue of functions to be executed, once for each matched element.
     * 
     * @param queueName A string containing the name of the queue. Defaults to fx, the standard effects queue.
     * @param callback The new function to add to the queue, with a function to call that will dequeue the next item.
     */
    queue(queueName: string, callback: Function): JQuery;
}
declare module "jquery" {
    export = $;
}
declare var jQuery: JQueryStatic;
declare var $: JQueryStatic;// Type definitions for jQueryUI 1.9
// Project: http://jqueryui.com/
// Definitions by: Boris Yankov <https://github.com/borisyankov/>, John Reilly <https://github.com/johnnyreilly>
// Definitions: https://github.com/borisyankov/DefinitelyTyped


/// <reference path="./jquery.d.ts"/>

declare module JQueryUI {
    // Accordion //////////////////////////////////////////////////

    interface AccordionOptions {
        active?: any; // boolean or number
        animate?: any; // boolean, number, string or object
        collapsible?: boolean;
        disabled?: boolean;
        event?: string;
        header?: string;
        heightStyle?: string;
        icons?: any;
    }

    interface AccordionUIParams {
        newHeader: JQuery;
        oldHeader: JQuery;
        newPanel: JQuery;
        oldPanel: JQuery;
    }

    interface AccordionEvent {
        (event: Event, ui: AccordionUIParams): void;
    }

    interface AccordionEvents {
        activate?: AccordionEvent;
        beforeActivate?: AccordionEvent;
        create?: AccordionEvent;
    }

    interface Accordion extends Widget, AccordionOptions, AccordionEvents {
    }


    // Autocomplete //////////////////////////////////////////////////

    interface AutocompleteOptions {
        appendTo?: any; //Selector;
        autoFocus?: boolean;
        delay?: number;
        disabled?: boolean;
        minLength?: number;
        position?: string;
        source?: any; // [], string or ()
    }

    interface AutocompleteUIParams {

    }

    interface AutocompleteEvent {
        (event: Event, ui: AutocompleteUIParams): void;
    }

    interface AutocompleteEvents {
        change?: AutocompleteEvent;
        close?: AutocompleteEvent;
        create?: AutocompleteEvent;
        focus?: AutocompleteEvent;
        open?: AutocompleteEvent;
        response?: AutocompleteEvent;
        search?: AutocompleteEvent;
        select?: AutocompleteEvent;
    }

    interface Autocomplete extends Widget, AutocompleteOptions, AutocompleteEvents {
        escapeRegex: (value: string) => string;
    }


    // Button //////////////////////////////////////////////////

    interface ButtonOptions {
        disabled?: boolean;
        icons?: any;
        label?: string;
        text?: boolean;
    }

    interface Button extends Widget, ButtonOptions {
    }


    // Datepicker //////////////////////////////////////////////////

    interface DatepickerOptions {
        /**
         * An input element that is to be updated with the selected date from the datepicker. Use the altFormat option to change the format of the date within this field. Leave as blank for no alternate field.
         */
        altField?: any; // Selector, jQuery or Element
        /**
         * The dateFormat to be used for the altField option. This allows one date format to be shown to the user for selection purposes, while a different format is actually sent behind the scenes. For a full list of the possible formats see the formatDate function
         */
        altFormat?: string;
        /**
         * The text to display after each date field, e.g., to show the required format.
         */
        appendText?: string;
        /**
         * Set to true to automatically resize the input field to accommodate dates in the current dateFormat.
         */
        autoSize?: boolean;
        /**
         * A function that takes an input field and current datepicker instance and returns an options object to update the datepicker with. It is called just before the datepicker is displayed.
         */
        beforeShow?: (input: Element, inst: any) => JQueryUI.DatepickerOptions;
        /**
         * A function that takes a date as a parameter and must return an array with:
         * [0]: true/false indicating whether or not this date is selectable
         * [1]: a CSS class name to add to the date's cell or "" for the default presentation
         * [2]: an optional popup tooltip for this date
         * The function is called for each day in the datepicker before it is displayed.
         */
        beforeShowDay?: (date: Date) => any[];
        /**
         * A URL of an image to use to display the datepicker when the showOn option is set to "button" or "both". If set, the buttonText option becomes the alt value and is not directly displayed.
         */
        buttonImage?: string;
        /**
         * Whether the button image should be rendered by itself instead of inside a button element. This option is only relevant if the buttonImage option has also been set.
         */
        buttonImageOnly?: boolean;
        /**
         * The text to display on the trigger button. Use in conjunction with the showOn option set to "button" or "both".
         */
        buttonText?: string;
        /**
         * A function to calculate the week of the year for a given date. The default implementation uses the ISO 8601 definition: weeks start on a Monday; the first week of the year contains the first Thursday of the year.
         */
        calculateWeek?: (date: Date) => string;
        /**
         * Whether the month should be rendered as a dropdown instead of text.
         */
        changeMonth?: boolean;
        /**
         * Whether the year should be rendered as a dropdown instead of text. Use the yearRange option to control which years are made available for selection.
         */
        changeYear?: boolean;
        /**
         * The text to display for the close link. Use the showButtonPanel option to display this button.
         */
        closeText?: string;
        /**
         * When true, entry in the input field is constrained to those characters allowed by the current dateFormat option.
         */
        constrainInput?: boolean;
        /**
         * The text to display for the current day link. Use the showButtonPanel option to display this button.
         */
        currentText?: string;
        /**
         * The format for parsed and displayed dates. For a full list of the possible formats see the formatDate function.
         */
        dateFormat?: string;
        /**
         * The list of long day names, starting from Sunday, for use as requested via the dateFormat option.
         */
        dayNames?: string[];
        /**
         * The list of minimised day names, starting from Sunday, for use as column headers within the datepicker.
         */
        dayNamesMin?: string[];
        /**
         * The list of abbreviated day names, starting from Sunday, for use as requested via the dateFormat option.
         */
        dayNamesShort?: string[];
        /**
         * Set the date to highlight on first opening if the field is blank. Specify either an actual date via a Date object or as a string in the current dateFormat, or a number of days from today (e.g. +7) or a string of values and periods ('y' for years, 'm' for months, 'w' for weeks, 'd' for days, e.g. '+1m +7d'), or null for today.
         * Multiple types supported:
         * Date: A date object containing the default date.
         * Number: A number of days from today. For example 2 represents two days from today and -1 represents yesterday.
         * String: A string in the format defined by the dateFormat option, or a relative date. Relative dates must contain value and period pairs; valid periods are "y" for years, "m" for months, "w" for weeks, and "d" for days. For example, "+1m +7d" represents one month and seven days from today.
         */
        defaultDate?: any; // Date, number or string
        /**
         * Control the speed at which the datepicker appears, it may be a time in milliseconds or a string representing one of the three predefined speeds ("slow", "normal", "fast").
         */
        duration?: string;
        /**
         * Set the first day of the week: Sunday is 0, Monday is 1, etc.
         */
        firstDay?: number;
        /**
         * When true, the current day link moves to the currently selected date instead of today.
         */
        gotoCurrent?: boolean;
        /**
         * Normally the previous and next links are disabled when not applicable (see the minDate and maxDate options). You can hide them altogether by setting this attribute to true.
         */
        hideIfNoPrevNext?: boolean;
        /**
         * Whether the current language is drawn from right to left.
         */
        isRTL?: boolean;
        /**
         * The maximum selectable date. When set to null, there is no maximum.
         * Multiple types supported:
         * Date: A date object containing the maximum date.
         * Number: A number of days from today. For example 2 represents two days from today and -1 represents yesterday.
         * String: A string in the format defined by the dateFormat option, or a relative date. Relative dates must contain value and period pairs; valid periods are "y" for years, "m" for months, "w" for weeks, and "d" for days. For example, "+1m +7d" represents one month and seven days from today.
         */
        maxDate?: any; // Date, number or string
        /**
         * The minimum selectable date. When set to null, there is no minimum.
         * Multiple types supported:
         * Date: A date object containing the minimum date.
         * Number: A number of days from today. For example 2 represents two days from today and -1 represents yesterday.
         * String: A string in the format defined by the dateFormat option, or a relative date. Relative dates must contain value and period pairs; valid periods are "y" for years, "m" for months, "w" for weeks, and "d" for days. For example, "+1m +7d" represents one month and seven days from today.
         */
        minDate?: any; // Date, number or string
        /**
         * The list of full month names, for use as requested via the dateFormat option.
         */
        monthNames?: string[];
        /**
         * The list of abbreviated month names, as used in the month header on each datepicker and as requested via the dateFormat option.
         */
        monthNamesShort?: string[];
        /**
         * Whether the prevText and nextText options should be parsed as dates by the formatDate function, allowing them to display the target month names for example.
         */
        navigationAsDateFormat?: boolean;
        /**
         * The text to display for the next month link. With the standard ThemeRoller styling, this value is replaced by an icon.
         */
        nextText?: string;
        /**
         * The number of months to show at once.
         * Multiple types supported:
         * Number: The number of months to display in a single row.
         * Array: An array defining the number of rows and columns to display.
         */
        numberOfMonths?: any; // number or number[]
        /**
         * Called when the datepicker moves to a new month and/or year. The function receives the selected year, month (1-12), and the datepicker instance as parameters. this refers to the associated input field.
         */
        onChangeMonthYear?: (year: number, month: number, inst: any) => void;
        /**
         * Called when the datepicker is closed, whether or not a date is selected. The function receives the selected date as text ("" if none) and the datepicker instance as parameters. this refers to the associated input field.
         */
        onClose?: (dateText: string, inst: any) => void;
        /**
         * Called when the datepicker is selected. The function receives the selected date as text and the datepicker instance as parameters. this refers to the associated input field.
         */
        onSelect?: (dateText: string, inst: any) => void;
        /**
         * The text to display for the previous month link. With the standard ThemeRoller styling, this value is replaced by an icon.
         */
        prevText?: string;
        /**
         * Whether days in other months shown before or after the current month are selectable. This only applies if the showOtherMonths option is set to true.
         */
        selectOtherMonths?: boolean;
        /**
         * The cutoff year for determining the century for a date (used in conjunction with dateFormat 'y'). Any dates entered with a year value less than or equal to the cutoff year are considered to be in the current century, while those greater than it are deemed to be in the previous century.
         * Multiple types supported:
         * Number: A value between 0 and 99 indicating the cutoff year.
         * String: A relative number of years from the current year, e.g., "+3" or "-5".
         */
        shortYearCutoff?: any; // number or string
        /**
         * The name of the animation used to show and hide the datepicker. Use "show" (the default), "slideDown", "fadeIn", any of the jQuery UI effects. Set to an empty string to disable animation.
         */
        showAnim?: string;
        /**
         * Whether to display a button pane underneath the calendar. The button pane contains two buttons, a Today button that links to the current day, and a Done button that closes the datepicker. The buttons' text can be customized using the currentText and closeText options respectively.
         */
        showButtonPanel?: boolean;
        /**
         * When displaying multiple months via the numberOfMonths option, the showCurrentAtPos option defines which position to display the current month in.
         */
        showCurrentAtPos?: number;
        /**
         * Whether to show the month after the year in the header.
         */
        showMonthAfterYear?: boolean;
        /**
         * When the datepicker should appear. The datepicker can appear when the field receives focus ("focus"), when a button is clicked ("button"), or when either event occurs ("both").
         */
        showOn?: string;
        /**
         * If using one of the jQuery UI effects for the showAnim option, you can provide additional settings for that animation via this option.
         */
        showOptions?: any; // TODO
        /**
         * Whether to display dates in other months (non-selectable) at the start or end of the current month. To make these days selectable use the selectOtherMonths option.
         */
        showOtherMonths?: boolean;
        /**
         * When true, a column is added to show the week of the year. The calculateWeek option determines how the week of the year is calculated. You may also want to change the firstDay option.
         */
        showWeek?: boolean;
        /**
         * Set how many months to move when clicking the previous/next links.
         */
        stepMonths?: number;
        /**
         * The text to display for the week of the year column heading. Use the showWeek option to display this column.
         */
        weekHeader?: string;
        /**
         * The range of years displayed in the year drop-down: either relative to today's year ("-nn:+nn"), relative to the currently selected year ("c-nn:c+nn"), absolute ("nnnn:nnnn"), or combinations of these formats ("nnnn:-nn"). Note that this option only affects what appears in the drop-down, to restrict which dates may be selected use the minDate and/or maxDate options.
         */
        yearRange?: string;
        /**
         * Additional text to display after the year in the month headers.
         */
        yearSuffix?: string;
    }

    interface DatepickerFormatDateOptions {
        dayNamesShort?: string[];
        dayNames?: string[];
        monthNamesShort?: string[];
        monthNames?: string[];
    }

    interface Datepicker extends Widget, DatepickerOptions {
        regional: { [languageCod3: string]: any; };
        setDefaults(defaults: DatepickerOptions): void;
        formatDate(format: string, date: Date, settings?: DatepickerFormatDateOptions): string;
        parseDate(format: string, date: string, settings?: DatepickerFormatDateOptions): Date;
        iso8601Week(date: Date): number;
        noWeekends(date: Date): any[];
    }


    // Dialog //////////////////////////////////////////////////

    interface DialogOptions {
        autoOpen?: boolean;
        buttons?: any; // object or []
        closeOnEscape?: boolean;
        closeText?: string;
        dialogClass?: string;
        disabled?: boolean;
        draggable?: boolean;
        height?: any; // number or string
        maxHeight?: number;
        maxWidth?: number;
        minHeight?: number;
        minWidth?: number;
        modal?: boolean;
        position?: any; // object, string or []
        resizable?: boolean;
        show?: any; // number, string or object
        stack?: boolean;
        title?: string;
        width?: any; // number or string
        zIndex?: number;

        close?: DialogEvent;
    }

    interface DialogUIParams {
    }

    interface DialogEvent {
        (event: Event, ui: DialogUIParams): void;
    }

    interface DialogEvents {
        beforeClose?: DialogEvent;
        close?: DialogEvent;
        create?: DialogEvent;
        drag?: DialogEvent;
        dragStart?: DialogEvent;
        dragStop?: DialogEvent;
        focus?: DialogEvent;
        open?: DialogEvent;
        resize?: DialogEvent;
        resizeStart?: DialogEvent;
        resizeStop?: DialogEvent;
    }

    interface Dialog extends Widget, DialogOptions, DialogEvents {
    }


    // Draggable //////////////////////////////////////////////////

    interface DraggableEventUIParams {
        helper: JQuery;
        position: { top: number; left: number; };
        offset: { top: number; left: number; };
    }

    interface DraggableEvent {
        (event: Event, ui: DraggableEventUIParams): void;
    }

    interface DraggableOptions {
        disabled?: boolean;
        addClasses?: boolean;
        appendTo?: any;
        axis?: string;
        cancel?: string;
        connectToSortable?: string;
        containment?: any;
        cursor?: string;
        cursorAt?: any;
        delay?: number;
        distance?: number;
        grid?: number[];
        handle?: any;
        helper?: any;
        iframeFix?: any;
        opacity?: number;
        refreshPositions?: boolean;
        revert?: any;
        revertDuration?: number;
        scope?: string;
        scroll?: boolean;
        scrollSensitivity?: number;
        scrollSpeed?: number;
        snap?: any;
        snapMode?: string;
        snapTolerance?: number;
        stack?: string;
        zIndex?: number;
    }

    interface DraggableEvents {
        create?: DraggableEvent;
        start?: DraggableEvent;
        drag?: DraggableEvent;
        stop?: DraggableEvent;
    }

    interface Draggable extends Widget, DraggableOptions, DraggableEvent {
    }


    // Droppable //////////////////////////////////////////////////

    interface DroppableEventUIParam {
        draggable: JQuery;
        helper: JQuery;
        position: { top: number; left: number; };
        offset: { top: number; left: number; };
    }

    interface DroppableEvent {
        (event: Event, ui: DroppableEventUIParam): void;
    }

    interface DroppableOptions {
        disabled?: boolean;
        accept?: any;
        activeClass?: string;
        greedy?: boolean;
        hoverClass?: string;
        scope?: string;
        tolerance?: string;
    }

    interface DroppableEvents {
        create?: DroppableEvent;
        activate?: DroppableEvent;
        deactivate?: DroppableEvent;
        over?: DroppableEvent;
        out?: DroppableEvent;
        drop?: DroppableEvent;
    }

    interface Droppable extends Widget, DroppableOptions, DroppableEvents {
    }

    // Menu //////////////////////////////////////////////////

    interface MenuOptions {
        disabled?: boolean;
        icons?: any;
        menus?: string;
        position?: any; // TODO
        role?: string;
    }

    interface MenuUIParams {
    }

    interface MenuEvent {
        (event: Event, ui: MenuUIParams): void;
    }

    interface MenuEvents {
        blur?: MenuEvent;
        create?: MenuEvent;
        focus?: MenuEvent;
        select?: MenuEvent;
    }

    interface Menu extends Widget, MenuOptions, MenuEvents {
    }


    // Progressbar //////////////////////////////////////////////////

    interface ProgressbarOptions {
        disabled?: boolean;
        value?: number;
    }

    interface ProgressbarUIParams {
    }

    interface ProgressbarEvent {
        (event: Event, ui: ProgressbarUIParams): void;
    }

    interface ProgressbarEvents {
        change?: ProgressbarEvent;
        complete?: ProgressbarEvent;
        create?: ProgressbarEvent;
    }

    interface Progressbar extends Widget, ProgressbarOptions, ProgressbarEvents {
    }


    // Resizable //////////////////////////////////////////////////

    interface ResizableOptions {
        alsoResize?: any; // Selector, JQuery or Element
        animate?: boolean;
        animateDuration?: any; // number or string
        animateEasing?: string;
        aspectRatio?: any; // boolean or number
        autoHide?: boolean;
        cancel?: string;
        containment?: any; // Selector, Element or string
        delay?: number;
        disabled?: boolean;
        distance?: number;
        ghost?: boolean;
        grid?: any;
        handles?: any; // string or object
        helper?: string;
        maxHeight?: number;
        maxWidth?: number;
        minHeight?: number;
        minWidth?: number;
    }

    interface ResizableUIParams {
        element: JQuery;
        helper: JQuery;
        originalElement: JQuery;
        originalPosition: any;
        originalSize: any;
        position: any;
        size: any;
    }

    interface ResizableEvent {
        (event: Event, ui: ResizableUIParams): void;
    }

    interface ResizableEvents {
        resize?: ResizableEvent;
        start?: ResizableEvent;
        stop?: ResizableEvent;
    }

    interface Resizable extends Widget, ResizableOptions, ResizableEvents {
    }


    // Selectable //////////////////////////////////////////////////

    interface SelectableOptions {
        autoRefresh?: boolean;
        cancel?: string;
        delay?: number;
        disabled?: boolean;
        distance?: number;
        filter?: string;
        tolerance?: string;
    }

    interface SelectableEvents {
        selected? (event: Event, ui: { selected?: Element; }): void;
        selecting? (event: Event, ui: { selecting?: Element; }): void;
        start? (event: Event, ui: any): void;
        stop? (event: Event, ui: any): void;
        unselected? (event: Event, ui: { unselected: Element; }): void;
        unselecting? (event: Event, ui: { unselecting: Element; }): void;
    }

    interface Selectable extends Widget, SelectableOptions, SelectableEvents {
    }

    // Slider //////////////////////////////////////////////////

    interface SliderOptions {
        animate?: any; // boolean, string or number
        disabled?: boolean;
        max?: number;
        min?: number;
        orientation?: string;
        range?: any; // boolean or string
        step?: number;
        // value?: number;
        // values?: number[];
    }

    interface SliderUIParams {
    }

    interface SliderEvent {
        (event: Event, ui: SliderUIParams): void;
    }

    interface SliderEvents {
        change?: SliderEvent;
        create?: SliderEvent;
        slide?: SliderEvent;
        start?: SliderEvent;
        stop?: SliderEvent;
    }

    interface Slider extends Widget, SliderOptions, SliderEvents {
    }


    // Sortable //////////////////////////////////////////////////

    interface SortableOptions extends SortableEvents {
        appendTo?: any; // jQuery, Element, Selector or string
        axis?: string;
        cancel?: any; // Selector
        connectWith?: any; // Selector
        containment?: any; // Element, Selector or string
        cursor?: string;
        cursorAt?: any;
        delay?: number;
        disabled?: boolean;
        distance?: number;
        dropOnEmpty?: boolean;
        forceHelperSize?: boolean;
        forcePlaceholderSize?: boolean;
        grid?: number[];
        handle?: any; // Selector or Element
        items?: any; // Selector
        opacity?: number;
        placeholder?: string;
        revert?: any; // boolean or number
        scroll?: boolean;
        scrollSensitivity?: number;
        scrollSpeed?: number;
        tolerance?: string;
        zIndex?: number;
    }

    interface SortableUIParams {
        helper: JQuery;
        item: JQuery;
        offset: any;
        position: any;
        originalPosition: any;
        sender: JQuery;
        placeholder: JQuery;
    }

    interface SortableEvent {
        (event: JQueryEventObject, ui: SortableUIParams): void;
    }

    interface SortableEvents {
        activate?: SortableEvent;
        beforeStop?: SortableEvent;
        change?: SortableEvent;
        deactivate?: SortableEvent;
        out?: SortableEvent;
        over?: SortableEvent;
        receive?: SortableEvent;
        remove?: SortableEvent;
        sort?: SortableEvent;
        start?: SortableEvent;
        stop?: SortableEvent;
        update?: SortableEvent;
    }

    interface Sortable extends Widget, SortableOptions, SortableEvents {
    }


    // Spinner //////////////////////////////////////////////////

    interface SpinnerOptions {
        culture?: string;
        disabled?: boolean;
        icons?: any;
        incremental?: any; // boolean or ()
        max?: any; // number or string
        min?: any; // number or string
        numberFormat?: string;
        page?: number;
        step?: any; // number or string
    }

    interface SpinnerUIParams {
    }

    interface SpinnerEvent {
        (event: Event, ui: SpinnerUIParams): void;
    }

    interface SpinnerEvents {
        spin?: SpinnerEvent;
        start?: SpinnerEvent;
        stop?: SpinnerEvent;
    }

    interface Spinner extends Widget, SpinnerOptions, SpinnerEvents {
    }


    // Tabs //////////////////////////////////////////////////

    interface TabsOptions {
        active?: any; // boolean or number
        collapsible?: boolean;
        disabled?: any; // boolean or []
        event?: string;
        heightStyle?: string;
        hide?: any; // boolean, number, string or object
        show?: any; // boolean, number, string or object

        activate?: TabsEvent;
    }

    interface TabsUIParams {
        newTab: JQuery;
        oldTab: JQuery;
        newPanel: JQuery;
        oldPanel: JQuery;
    }

    interface TabsEvent {
        (event: Event, ui: TabsUIParams): void;
    }

    interface TabsEvents {
        activate?: TabsEvent;
        beforeActivate?: TabsEvent;
        beforeLoad?: TabsEvent;
        load?: TabsEvent;
    }

    interface Tabs extends Widget, TabsOptions, TabsEvents {
    }


    // Tooltip //////////////////////////////////////////////////

    interface TooltipOptions {
        content?: any; // () or string
        disabled?: boolean;
        hide?: any; // boolean, number, string or object
        items?: string;
        position?: any; // TODO
        show?: any; // boolean, number, string or object
        tooltipClass?: string;
        track?: boolean;
    }

    interface TooltipUIParams {
    }

    interface TooltipEvent {
        (event: Event, ui: TooltipUIParams): void;
    }

    interface TooltipEvents {
        close?: TooltipEvent;
        open?: TooltipEvent;
    }

    interface Tooltip extends Widget, TooltipOptions, TooltipEvents {
    }


    // Effects //////////////////////////////////////////////////

    interface EffectOptions {
        effect: string;
        easing?: string;
        duration: any;
        complete: Function;
    }

    interface BlindEffect {
        direction?: string;
    }

    interface BounceEffect {
        distance?: number;
        times?: number;
    }

    interface ClipEffect {
        direction?: number;
    }

    interface DropEffect {
        direction?: number;
    }

    interface ExplodeEffect {
        pieces?: number;
    }

    interface FadeEffect { }

    interface FoldEffect {
        size?: any;
        horizFirst?: boolean;
    }

    interface HighlightEffect {
        color?: string;
    }

    interface PuffEffect {
        percent?: number;
    }

    interface PulsateEffect {
        times?: number;
    }

    interface ScaleEffect {
        direction?: string;
        origin?: string[];
        percent?: number;
        scale?: string;
    }

    interface ShakeEffect {
        direction?: string;
        distance?: number;
        times?: number;
    }

    interface SizeEffect {
        to?: any;
        origin?: string[];
        scale?: string;
    }

    interface SlideEffect {
        direction?: string;
        distance?: number;
    }

    interface TransferEffect {
        className?: string;
        to?: string;
    }

    interface JQueryPositionOptions {
        my?: string;
        at?: string;
        of?: any;
        collision?: string;
        using?: Function;
        within?: any;
    }


    // UI //////////////////////////////////////////////////

    interface MouseOptions {
        cancel?: string;
        delay?: number;
        distance?: number;
    }

    interface KeyCode {
        BACKSPACE: number;
        COMMA: number;
        DELETE: number;
        DOWN: number;
        END: number;
        ENTER: number;
        ESCAPE: number;
        HOME: number;
        LEFT: number;
        NUMPAD_ADD: number;
        NUMPAD_DECIMAL: number;
        NUMPAD_DIVIDE: number;
        NUMPAD_ENTER: number;
        NUMPAD_MULTIPLY: number;
        NUMPAD_SUBTRACT: number;
        PAGE_DOWN: number;
        PAGE_UP: number;
        PERIOD: number;
        RIGHT: number;
        SPACE: number;
        TAB: number;
        UP: number;
    }

    interface UI {
        mouse(method: string): JQuery;
        mouse(options: MouseOptions): JQuery;
        mouse(optionLiteral: string, optionName: string, optionValue: any): JQuery;
        mouse(optionLiteral: string, optionValue: any): any;

        accordion: Accordion;
        autocomplete: Autocomplete;
        button: Button;
        buttonset: Button;
        datepicker: Datepicker;
        dialog: Dialog;
        keyCode: KeyCode;
        menu: Menu;
        progressbar: Progressbar;
        slider: Slider;
        spinner: Spinner;
        tabs: Tabs;
        tooltip: Tooltip;
        version: string;
    }


    // Widget //////////////////////////////////////////////////

    interface WidgetOptions {
        disabled?: boolean;
        hide?: any;
        show?: any;
    }

    interface Widget {
        (methodName: string): JQuery;
        (options: WidgetOptions): JQuery;
        (options: AccordionOptions): JQuery;
        (optionLiteral: string, optionName: string): any;
        (optionLiteral: string, options: WidgetOptions): any;
        (optionLiteral: string, optionName: string, optionValue: any): JQuery;

        (name: string, prototype: any): JQuery;
        (name: string, base: Function, prototype: any): JQuery;
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////

}

interface JQuery {

    accordion(): JQuery;
    accordion(methodName: 'destroy'): void;
    accordion(methodName: 'disable'): void;
    accordion(methodName: 'enable'): void;
    accordion(methodName: 'refresh'): void;
    accordion(methodName: 'widget'): JQuery;
    accordion(methodName: string): JQuery;
    accordion(options: JQueryUI.AccordionOptions): JQuery;
    accordion(optionLiteral: string, optionName: string): any;
    accordion(optionLiteral: string, options: JQueryUI.AccordionOptions): any;
    accordion(optionLiteral: string, optionName: string, optionValue: any): JQuery;

    autocomplete(): JQuery;
    autocomplete(methodName: 'close'): void;
    autocomplete(methodName: 'destroy'): void;
    autocomplete(methodName: 'disable'): void;
    autocomplete(methodName: 'enable'): void;
    autocomplete(methodName: 'search', value?: string): void;
    autocomplete(methodName: 'widget'): JQuery;
    autocomplete(methodName: string): JQuery;
    autocomplete(options: JQueryUI.AutocompleteOptions): JQuery;
    autocomplete(optionLiteral: string, optionName: string): any;
    autocomplete(optionLiteral: string, options: JQueryUI.AutocompleteOptions): any;
    autocomplete(optionLiteral: string, optionName: string, optionValue: any): JQuery;

    button(): JQuery;
    button(methodName: 'destroy'): void;
    button(methodName: 'disable'): void;
    button(methodName: 'enable'): void;
    button(methodName: 'refresh'): void;
    button(methodName: 'widget'): JQuery;
    button(methodName: string): JQuery;
    button(options: JQueryUI.ButtonOptions): JQuery;
    button(optionLiteral: string, optionName: string): any;
    button(optionLiteral: string, options: JQueryUI.ButtonOptions): any;
    button(optionLiteral: string, optionName: string, optionValue: any): JQuery;

    buttonset(): JQuery;
    buttonset(methodName: 'destroy'): void;
    buttonset(methodName: 'disable'): void;
    buttonset(methodName: 'enable'): void;
    buttonset(methodName: 'refresh'): void;
    buttonset(methodName: 'widget'): JQuery;
    buttonset(methodName: string): JQuery;
    buttonset(options: JQueryUI.ButtonOptions): JQuery;
    buttonset(optionLiteral: string, optionName: string): any;
    buttonset(optionLiteral: string, options: JQueryUI.ButtonOptions): any;
    buttonset(optionLiteral: string, optionName: string, optionValue: any): JQuery;

    /**
     * Initialize a datepicker
     */
    datepicker(): JQuery;
    /**
     * Removes the datepicker functionality completely. This will return the element back to its pre-init state.
     *
     * @param methodName 'destroy'
     */
    datepicker(methodName: 'destroy'): JQuery;
    /**
     * Opens the datepicker in a dialog box.
     *
     * @param methodName 'dialog'
     * @param date The initial date.
     * @param onSelect A callback function when a date is selected. The function receives the date text and date picker instance as parameters.
     * @param settings The new settings for the date picker.
     * @param pos The position of the top/left of the dialog as [x, y] or a MouseEvent that contains the coordinates. If not specified the dialog is centered on the screen.
     */
    datepicker(methodName: 'dialog', date: Date, onSelect?: () => void, settings?: JQueryUI.DatepickerOptions, pos?: number[]): JQuery;
    /**
     * Opens the datepicker in a dialog box.
     *
     * @param methodName 'dialog'
     * @param date The initial date.
     * @param onSelect A callback function when a date is selected. The function receives the date text and date picker instance as parameters.
     * @param settings The new settings for the date picker.
     * @param pos The position of the top/left of the dialog as [x, y] or a MouseEvent that contains the coordinates. If not specified the dialog is centered on the screen.
     */
    datepicker(methodName: 'dialog', date: Date, onSelect?: () => void, settings?: JQueryUI.DatepickerOptions, pos?: MouseEvent): JQuery;
    /**
     * Opens the datepicker in a dialog box.
     *
     * @param methodName 'dialog'
     * @param date The initial date.
     * @param onSelect A callback function when a date is selected. The function receives the date text and date picker instance as parameters.
     * @param settings The new settings for the date picker.
     * @param pos The position of the top/left of the dialog as [x, y] or a MouseEvent that contains the coordinates. If not specified the dialog is centered on the screen.
     */
    datepicker(methodName: 'dialog', date: string, onSelect?: () => void, settings?: JQueryUI.DatepickerOptions, pos?: number[]): JQuery;
    /**
     * Opens the datepicker in a dialog box.
     *
     * @param methodName 'dialog'
     * @param date The initial date.
     * @param onSelect A callback function when a date is selected. The function receives the date text and date picker instance as parameters.
     * @param settings The new settings for the date picker.
     * @param pos The position of the top/left of the dialog as [x, y] or a MouseEvent that contains the coordinates. If not specified the dialog is centered on the screen.
     */
    datepicker(methodName: 'dialog', date: string, onSelect?: () => void, settings?: JQueryUI.DatepickerOptions, pos?: MouseEvent): JQuery;
    /**
     * Returns the current date for the datepicker or null if no date has been selected.
     *
     * @param methodName 'getDate'
     */
    datepicker(methodName: 'getDate'): Date;
    /**
     * Close a previously opened date picker.
     *
     * @param methodName 'hide'
     */
    datepicker(methodName: 'hide'): JQuery;
    /**
     * Determine whether a date picker has been disabled.
     *
     * @param methodName 'isDisabled'
     */
    datepicker(methodName: 'isDisabled'): boolean;
    /**
     * Redraw the date picker, after having made some external modifications.
     *
     * @param methodName 'refresh'
     */
    datepicker(methodName: 'refresh'): JQuery;
    /**
     * Sets the date for the datepicker. The new date may be a Date object or a string in the current date format (e.g., "01/26/2009"), a number of days from today (e.g., +7) or a string of values and periods ("y" for years, "m" for months, "w" for weeks, "d" for days, e.g., "+1m +7d"), or null to clear the selected date.
     *
     * @param methodName 'setDate'
     * @param date The new date.
     */
    datepicker(methodName: 'setDate', date: Date): JQuery;
    /**
     * Sets the date for the datepicker. The new date may be a Date object or a string in the current date format (e.g., "01/26/2009"), a number of days from today (e.g., +7) or a string of values and periods ("y" for years, "m" for months, "w" for weeks, "d" for days, e.g., "+1m +7d"), or null to clear the selected date.
     *
     * @param methodName 'setDate'
     * @param date The new date.
     */
    datepicker(methodName: 'setDate', date: string): JQuery;
    /**
     * Open the date picker. If the datepicker is attached to an input, the input must be visible for the datepicker to be shown.
     *
     * @param methodName 'show'
     */
    datepicker(methodName: 'show'): JQuery;
    /**
     * Returns a jQuery object containing the datepicker.
     *
     * @param methodName 'widget'
     */
    datepicker(methodName: 'widget'): JQuery;

    /**
     * Get the altField option, after initialization
     *
     * @param methodName 'option'
     * @param optionName 'altField'
     */
    datepicker(methodName: 'option', optionName: 'altField'): any;
    /**
     * Set the altField option, after initialization
     *
     * @param methodName 'option'
     * @param optionName 'altField'
     * @param altFieldValue An input element that is to be updated with the selected date from the datepicker. Use the altFormat option to change the format of the date within this field. Leave as blank for no alternate field.
     */
    datepicker(methodName: 'option', optionName: 'altField', altFieldValue: string): JQuery;
    /**
     * Set the altField option, after initialization
     *
     * @param methodName 'option'
     * @param optionName 'altField'
     * @param altFieldValue An input element that is to be updated with the selected date from the datepicker. Use the altFormat option to change the format of the date within this field. Leave as blank for no alternate field.
     */
    datepicker(methodName: 'option', optionName: 'altField', altFieldValue: JQuery): JQuery;
    /**
     * Set the altField option, after initialization
     *
     * @param methodName 'option'
     * @param optionName 'altField'
     * @param altFieldValue An input element that is to be updated with the selected date from the datepicker. Use the altFormat option to change the format of the date within this field. Leave as blank for no alternate field.
     */
    datepicker(methodName: 'option', optionName: 'altField', altFieldValue: Element): JQuery;

    /**
     * Get the altFormat option, after initialization
     *
     * @param methodName 'option'
     * @param optionName 'altFormat'
     */
    datepicker(methodName: 'option', optionName: 'altFormat'): string;
    /**
     * Set the altFormat option, after initialization
     *
     * @param methodName 'option'
     * @param optionName 'altFormat'
     * @param altFormatValue The dateFormat to be used for the altField option. This allows one date format to be shown to the user for selection purposes, while a different format is actually sent behind the scenes. For a full list of the possible formats see the formatDate function
     */
    datepicker(methodName: 'option', optionName: 'altFormat', altFormatValue: string): JQuery;

    /**
     * Get the appendText option, after initialization
     *
     * @param methodName 'option'
     * @param optionName 'appendText'
     */
    datepicker(methodName: 'option', optionName: 'appendText'): string;
    /**
     * Set the appendText option, after initialization
     *
     * @param methodName 'option'
     * @param optionName 'appendText'
     * @param appendTextValue The text to display after each date field, e.g., to show the required format.
     */
    datepicker(methodName: 'option', optionName: 'appendText', appendTextValue: string): JQuery;

    /**
     * Get the autoSize option, after initialization
     *
     * @param methodName 'option'
     * @param optionName 'autoSize'
     */
    datepicker(methodName: 'option', optionName: 'autoSize'): boolean;
    /**
     * Set the autoSize option, after initialization
     *
     * @param methodName 'option'
     * @param optionName 'autoSize'
     * @param autoSizeValue Set to true to automatically resize the input field to accommodate dates in the current dateFormat.
     */
    datepicker(methodName: 'option', optionName: 'autoSize', autoSizeValue: boolean): JQuery;

    /**
     * Get the beforeShow option, after initialization
     *
     * @param methodName 'option'
     * @param optionName 'beforeShow'
     */
    datepicker(methodName: 'option', optionName: 'beforeShow'): (input: Element, inst: any) => JQueryUI.DatepickerOptions;
    /**
     * Set the beforeShow option, after initialization
     *
     * @param methodName 'option'
     * @param optionName 'beforeShow'
     * @param beforeShowValue A function that takes an input field and current datepicker instance and returns an options object to update the datepicker with. It is called just before the datepicker is displayed.
     */
    datepicker(methodName: 'option', optionName: 'beforeShow', beforeShowValue: (input: Element, inst: any) => JQueryUI.DatepickerOptions): JQuery;

    /**
     * Get the beforeShow option, after initialization
     *
     * @param methodName 'option'
     * @param optionName 'beforeShowDay'
     */
    datepicker(methodName: 'option', optionName: 'beforeShowDay'): (date: Date) => any[];
    /**
     * Set the beforeShow option, after initialization
     *
     * @param methodName 'option'
     * @param optionName 'beforeShowDay'
     * @param beforeShowDayValue A function that takes a date as a parameter and must return an array with:
     * [0]: true/false indicating whether or not this date is selectable
     * [1]: a CSS class name to add to the date's cell or "" for the default presentation
     * [2]: an optional popup tooltip for this date
     * The function is called for each day in the datepicker before it is displayed.
     */
    datepicker(methodName: 'option', optionName: 'beforeShowDay', beforeShowDayValue: (date: Date) => any[]): JQuery;

    /**
     * Get the buttonImage option, after initialization
     *
     * @param methodName 'option'
     * @param optionName 'buttonImage'
     */
    datepicker(methodName: 'option', optionName: 'buttonImage'): string;
    /**
     * Set the buttonImage option, after initialization
     *
     * @param methodName 'option'
     * @param optionName 'buttonImage'
     * @param buttonImageValue A URL of an image to use to display the datepicker when the showOn option is set to "button" or "both". If set, the buttonText option becomes the alt value and is not directly displayed.
     */
    datepicker(methodName: 'option', optionName: 'buttonImage', buttonImageValue: string): JQuery;

    /**
     * Get the buttonImageOnly option, after initialization
     *
     * @param methodName 'option'
     * @param optionName 'buttonImageOnly'
     */
    datepicker(methodName: 'option', optionName: 'buttonImageOnly'): boolean;
    /**
     * Set the buttonImageOnly option, after initialization
     *
     * @param methodName 'option'
     * @param optionName 'buttonImageOnly'
     * @param buttonImageOnlyValue Whether the button image should be rendered by itself instead of inside a button element. This option is only relevant if the buttonImage option has also been set.
     */
    datepicker(methodName: 'option', optionName: 'buttonImageOnly', buttonImageOnlyValue: boolean): JQuery;

    /**
     * Get the buttonText option, after initialization
     *
     * @param methodName 'option'
     * @param optionName 'buttonText'
     */
    datepicker(methodName: 'option', optionName: 'buttonText'): string;
    /**
     * Set the buttonText option, after initialization
     *
     * @param methodName 'option'
     * @param optionName 'buttonText'
     * @param buttonTextValue The text to display on the trigger button. Use in conjunction with the showOn option set to "button" or "both".
     */
    datepicker(methodName: 'option', optionName: 'buttonText', buttonTextValue: string): JQuery;

    /**
     * Get the calculateWeek option, after initialization
     *
     * @param methodName 'option'
     * @param optionName 'calculateWeek'
     */
    datepicker(methodName: 'option', optionName: 'calculateWeek'): (date: Date) => string;
    /**
     * Set the calculateWeek option, after initialization
     *
     * @param methodName 'option'
     * @param optionName 'calculateWeek'
     * @param calculateWeekValue A function to calculate the week of the year for a given date. The default implementation uses the ISO 8601 definition: weeks start on a Monday; the first week of the year contains the first Thursday of the year.
     */
    datepicker(methodName: 'option', optionName: 'calculateWeek', calculateWeekValue: (date: Date) => string): JQuery;

    /**
     * Get the changeMonth option, after initialization
     *
     * @param methodName 'option'
     * @param optionName 'changeMonth'
     */
    datepicker(methodName: 'option', optionName: 'changeMonth'): boolean;
    /**
     * Set the changeMonth option, after initialization
     *
     * @param methodName 'option'
     * @param optionName 'changeMonth'
     * @param changeMonthValue Whether the month should be rendered as a dropdown instead of text.
     */
    datepicker(methodName: 'option', optionName: 'changeMonth', changeMonthValue: boolean): JQuery;

    /**
     * Get the changeYear option, after initialization
     *
     * @param methodName 'option'
     * @param optionName 'changeYear'
     */
    datepicker(methodName: 'option', optionName: 'changeYear'): boolean;
    /**
     * Set the changeYear option, after initialization
     *
     * @param methodName 'option'
     * @param optionName 'changeYear'
     * @param changeYearValue Whether the year should be rendered as a dropdown instead of text. Use the yearRange option to control which years are made available for selection.
     */
    datepicker(methodName: 'option', optionName: 'changeYear', changeYearValue: boolean): JQuery;

    /**
     * Get the closeText option, after initialization
     *
     * @param methodName 'option'
     * @param optionName 'closeText'
     */
    datepicker(methodName: 'option', optionName: 'closeText'): string;
    /**
     * Set the closeText option, after initialization
     *
     * @param methodName 'option'
     * @param optionName 'closeText'
     * @param closeTextValue The text to display for the close link. Use the showButtonPanel option to display this button.
     */
    datepicker(methodName: 'option', optionName: 'closeText', closeTextValue: string): JQuery;

    /**
     * Get the constrainInput option, after initialization
     *
     * @param methodName 'option'
     * @param optionName 'constrainInput'
     */
    datepicker(methodName: 'option', optionName: 'constrainInput'): boolean;
    /**
     * Set the constrainInput option, after initialization
     *
     * @param methodName 'option'
     * @param optionName 'constrainInput'
     * @param constrainInputValue When true, entry in the input field is constrained to those characters allowed by the current dateFormat option.
     */
    datepicker(methodName: 'option', optionName: 'constrainInput', constrainInputValue: boolean): JQuery;

    /**
     * Get the currentText option, after initialization
     *
     * @param methodName 'option'
     * @param optionName 'currentText'
     */
    datepicker(methodName: 'option', optionName: 'currentText'): string;
    /**
     * Set the currentText option, after initialization
     *
     * @param methodName 'option'
     * @param optionName 'currentText'
     * @param currentTextValue The text to display for the current day link. Use the showButtonPanel option to display this button.
     */
    datepicker(methodName: 'option', optionName: 'currentText', currentTextValue: string): JQuery;

    /**
     * Get the dateFormat option, after initialization
     *
     * @param methodName 'option'
     * @param optionName 'dateFormat'
     */
    datepicker(methodName: 'option', optionName: 'dateFormat'): string;
    /**
     * Set the dateFormat option, after initialization
     *
     * @param methodName 'option'
     * @param optionName 'dateFormat'
     * @param dateFormatValue The format for parsed and displayed dates. For a full list of the possible formats see the formatDate function.
     */
    datepicker(methodName: 'option', optionName: 'dateFormat', dateFormatValue: string): JQuery;

    /**
     * Get the dayNames option, after initialization
     *
     * @param methodName 'option'
     * @param optionName 'dayNames'
     */
    datepicker(methodName: 'option', optionName: 'dayNames'): string[];
    /**
     * Set the dayNames option, after initialization
     *
     * @param methodName 'option'
     * @param optionName 'dayNames'
     * @param dayNamesValue The list of long day names, starting from Sunday, for use as requested via the dateFormat option.
     */
    datepicker(methodName: 'option', optionName: 'dayNames', dayNamesValue: string[]): JQuery;

    /**
     * Get the dayNamesMin option, after initialization
     *
     * @param methodName 'option'
     * @param optionName 'dayNamesMin'
     */
    datepicker(methodName: 'option', optionName: 'dayNamesMin'): string[];
    /**
     * Set the dayNamesMin option, after initialization
     *
     * @param methodName 'option'
     * @param optionName 'dayNamesMin'
     * @param dayNamesMinValue The list of minimised day names, starting from Sunday, for use as column headers within the datepicker.
     */
    datepicker(methodName: 'option', optionName: 'dayNamesMin', dayNamesMinValue: string[]): JQuery;

    /**
     * Get the dayNamesShort option, after initialization
     *
     * @param methodName 'option'
     * @param optionName 'dayNamesShort'
     */
    datepicker(methodName: 'option', optionName: 'dayNamesShort'): string[];
    /**
     * Set the dayNamesShort option, after initialization
     *
     * @param methodName 'option'
     * @param optionName 'dayNamesShort'
     * @param dayNamesShortValue The list of abbreviated day names, starting from Sunday, for use as requested via the dateFormat option.
     */
    datepicker(methodName: 'option', optionName: 'dayNamesShort', dayNamesShortValue: string[]): JQuery;

    /**
     * Get the defaultDate option, after initialization
     *
     * @param methodName 'option'
     * @param optionName 'defaultDate'
     */
    datepicker(methodName: 'option', optionName: 'defaultDate'): any;
    /**
     * Set the defaultDate option, after initialization
     *
     * @param methodName 'option'
     * @param optionName 'defaultDate'
     * @param defaultDateValue A date object containing the default date.
     */
    datepicker(methodName: 'option', optionName: 'defaultDate', defaultDateValue: Date): JQuery;
    /**
     * Set the defaultDate option, after initialization
     *
     * @param methodName 'option'
     * @param optionName 'defaultDate'
     * @param defaultDateValue A number of days from today. For example 2 represents two days from today and -1 represents yesterday.
     */
    datepicker(methodName: 'option', optionName: 'defaultDate', defaultDateValue: number): JQuery;
    /**
     * Set the defaultDate option, after initialization
     *
     * @param methodName 'option'
     * @param optionName 'defaultDate'
     * @param defaultDateValue A string in the format defined by the dateFormat option, or a relative date. Relative dates must contain value and period pairs; valid periods are "y" for years, "m" for months, "w" for weeks, and "d" for days. For example, "+1m +7d" represents one month and seven days from today.
     */
    datepicker(methodName: 'option', optionName: 'defaultDate', defaultDateValue: string): JQuery;

    /**
     * Get the duration option, after initialization
     *
     * @param methodName 'option'
     * @param optionName 'duration'
     */
    datepicker(methodName: 'option', optionName: 'duration'): string;
    /**
     * Set the duration option, after initialization
     *
     * @param methodName 'option'
     * @param optionName 'duration'
     * @param durationValue Control the speed at which the datepicker appears, it may be a time in milliseconds or a string representing one of the three predefined speeds ("slow", "normal", "fast").
     */
    datepicker(methodName: 'option', optionName: 'duration', durationValue: string): JQuery;

    /**
     * Get the firstDay option, after initialization
     *
     * @param methodName 'option'
     * @param optionName 'firstDay'
     */
    datepicker(methodName: 'option', optionName: 'firstDay'): number;
    /**
     * Set the firstDay option, after initialization
     *
     * @param methodName 'option'
     * @param optionName 'firstDay'
     * @param firstDayValue Set the first day of the week: Sunday is 0, Monday is 1, etc.
     */
    datepicker(methodName: 'option', optionName: 'firstDay', firstDayValue: number): JQuery;

    /**
     * Get the gotoCurrent option, after initialization
     *
     * @param methodName 'option'
     * @param optionName 'gotoCurrent'
     */
    datepicker(methodName: 'option', optionName: 'gotoCurrent'): boolean;
    /**
     * Set the gotoCurrent option, after initialization
     *
     * @param methodName 'option'
     * @param optionName 'gotoCurrent'
     * @param gotoCurrentValue When true, the current day link moves to the currently selected date instead of today.
     */
    datepicker(methodName: 'option', optionName: 'gotoCurrent', gotoCurrentValue: boolean): JQuery;

    /**
     * Gets the value currently associated with the specified optionName.
     *
     * @param methodName 'option'
     * @param optionName The name of the option to get.
     */
    datepicker(methodName: 'option', optionName: string): any;

    datepicker(methodName: 'option', optionName: string, ...otherParams: any[]): any; // Used for getting and setting options

    datepicker(methodName: string, ...otherParams: any[]): any;

    /**
     * Initialize a datepicker with the given options
     */
    datepicker(options: JQueryUI.DatepickerOptions): JQuery;

    dialog(): JQuery;
    dialog(methodName: 'close'): JQuery;
    dialog(methodName: 'destroy'): JQuery;
    dialog(methodName: 'isOpen'): boolean;
    dialog(methodName: 'moveToTop'): JQuery;
    dialog(methodName: 'open'): JQuery;
    dialog(methodName: 'widget'): JQuery;
    dialog(methodName: string): JQuery;
    dialog(options: JQueryUI.DialogOptions): JQuery;
    dialog(optionLiteral: string, optionName: string): any;
    dialog(optionLiteral: string, options: JQueryUI.DialogOptions): any;
    dialog(optionLiteral: string, optionName: string, optionValue: any): JQuery;

    draggable(): JQuery;
    draggable(methodName: 'destroy'): void;
    draggable(methodName: 'disable'): void;
    draggable(methodName: 'enable'): void;
    draggable(methodName: 'widget'): JQuery;
    draggable(methodName: string): JQuery;
    draggable(options: JQueryUI.DraggableOptions): JQuery;
    draggable(optionLiteral: string, optionName: string): any;
    draggable(optionLiteral: string, options: JQueryUI.DraggableOptions): any;
    draggable(optionLiteral: string, optionName: string, optionValue: any): JQuery;

    droppable(): JQuery;
    droppable(methodName: 'destroy'): void;
    droppable(methodName: 'disable'): void;
    droppable(methodName: 'enable'): void;
    droppable(methodName: 'widget'): JQuery;
    droppable(methodName: string): JQuery;
    droppable(options: JQueryUI.DroppableOptions): JQuery;
    droppable(optionLiteral: string, optionName: string): any;
    droppable(optionLiteral: string, options: JQueryUI.DraggableOptions): any;
    droppable(optionLiteral: string, optionName: string, optionValue: any): JQuery;

    menu(): JQuery;
    menu(methodName: 'blur'): void;
    menu(methodName: 'collapse', event?: JQueryEventObject): void;
    menu(methodName: 'collapseAll', event?: JQueryEventObject, all?: boolean): void;
    menu(methodName: 'destroy'): void;
    menu(methodName: 'disable'): void;
    menu(methodName: 'enable'): void;
    menu(methodName: string, event: JQueryEventObject, item: JQuery): void;
    menu(methodName: 'focus', event: JQueryEventObject, item: JQuery): void;
    menu(methodName: 'isFirstItem'): boolean;
    menu(methodName: 'isLastItem'): boolean;
    menu(methodName: 'next', event?: JQueryEventObject): void;
    menu(methodName: 'nextPage', event?: JQueryEventObject): void;
    menu(methodName: 'previous', event?: JQueryEventObject): void;
    menu(methodName: 'previousPage', event?: JQueryEventObject): void;
    menu(methodName: 'refresh'): void;
    menu(methodName: 'select', event?: JQueryEventObject): void;
    menu(methodName: 'widget'): JQuery;
    menu(methodName: string): JQuery;
    menu(options: JQueryUI.MenuOptions): JQuery;
    menu(optionLiteral: string, optionName: string): any;
    menu(optionLiteral: string, options: JQueryUI.MenuOptions): any;
    menu(optionLiteral: string, optionName: string, optionValue: any): JQuery;

    progressbar(): JQuery;
    progressbar(methodName: 'destroy'): void;
    progressbar(methodName: 'disable'): void;
    progressbar(methodName: 'enable'): void;
    progressbar(methodName: 'refresh'): void;
    progressbar(methodName: 'value'): any; // number or boolean
    progressbar(methodName: 'value', value: number): void;
    progressbar(methodName: 'value', value: boolean): void;
    progressbar(methodName: 'widget'): JQuery;
    progressbar(methodName: string): JQuery;
    progressbar(options: JQueryUI.ProgressbarOptions): JQuery;
    progressbar(optionLiteral: string, optionName: string): any;
    progressbar(optionLiteral: string, options: JQueryUI.ProgressbarOptions): any;
    progressbar(optionLiteral: string, optionName: string, optionValue: any): JQuery;

    resizable(): JQuery;
    resizable(methodName: 'destroy'): void;
    resizable(methodName: 'disable'): void;
    resizable(methodName: 'enable'): void;
    resizable(methodName: 'widget'): JQuery;
    resizable(methodName: string): JQuery;
    resizable(options: JQueryUI.ResizableOptions): JQuery;
    resizable(optionLiteral: string, optionName: string): any;
    resizable(optionLiteral: string, options: JQueryUI.ResizableOptions): any;
    resizable(optionLiteral: string, optionName: string, optionValue: any): JQuery;

    selectable(): JQuery;
    selectable(methodName: 'destroy'): void;
    selectable(methodName: 'disable'): void;
    selectable(methodName: 'enable'): void;
    selectable(methodName: 'widget'): JQuery;
    selectable(methodName: string): JQuery;
    selectable(options: JQueryUI.SelectableOptions): JQuery;
    selectable(optionLiteral: string, optionName: string): any;
    selectable(optionLiteral: string, options: JQueryUI.SelectableOptions): any;
    selectable(optionLiteral: string, optionName: string, optionValue: any): JQuery;

    slider(): JQuery;
    slider(methodName: 'destroy'): void;
    slider(methodName: 'disable'): void;
    slider(methodName: 'enable'): void;
    slider(methodName: 'refresh'): void;
    slider(methodName: 'value'): number;
    slider(methodName: 'value', value: number): void;
    slider(methodName: 'values'): Array<number>;
    slider(methodName: 'values', index: number): number;
    slider(methodName: string, index: number, value: number): void;
    slider(methodName: 'values', index: number, value: number): void;
    slider(methodName: string, values: Array<number>): void;
    slider(methodName: 'values', values: Array<number>): void;
    slider(methodName: 'widget'): JQuery;
    slider(methodName: string): JQuery;
    slider(options: JQueryUI.SliderOptions): JQuery;
    slider(optionLiteral: string, optionName: string): any;
    slider(optionLiteral: string, options: JQueryUI.SliderOptions): any;
    slider(optionLiteral: string, optionName: string, optionValue: any): JQuery;

    sortable(): JQuery;
    sortable(methodName: 'destroy'): void;
    sortable(methodName: 'disable'): void;
    sortable(methodName: 'enable'): void;
    sortable(methodName: 'widget'): JQuery;
    sortable(methodName: 'toArray'): string[];
    sortable(methodName: string): JQuery;
    sortable(options: JQueryUI.SortableOptions): JQuery;
    sortable(optionLiteral: string, optionName: string): any;
    sortable(optionLiteral: string, options: JQueryUI.SortableOptions): any;
    sortable(optionLiteral: string, optionName: string, optionValue: any): JQuery;

    spinner(): JQuery;
    spinner(methodName: 'destroy'): void;
    spinner(methodName: 'disable'): void;
    spinner(methodName: 'enable'): void;
    spinner(methodName: 'pageDown', pages?: number): void;
    spinner(methodName: 'pageUp', pages?: number): void;
    spinner(methodName: 'stepDown', steps?: number): void;
    spinner(methodName: 'stepUp', steps?: number): void;
    spinner(methodName: 'value'): number;
    spinner(methodName: 'value', value: number): void;
    spinner(methodName: 'widget'): JQuery;
    spinner(methodName: string): JQuery;
    spinner(options: JQueryUI.SpinnerOptions): JQuery;
    spinner(optionLiteral: string, optionName: string): any;
    spinner(optionLiteral: string, options: JQueryUI.SpinnerOptions): any;
    spinner(optionLiteral: string, optionName: string, optionValue: any): JQuery;

    tabs(): JQuery;
    tabs(methodName: 'destroy'): void;
    tabs(methodName: 'disable'): void;
    tabs(methodName: 'enable'): void;
    tabs(methodName: 'load', index: number): void;
    tabs(methodName: 'refresh'): void;
    tabs(methodName: 'widget'): JQuery;
    tabs(methodName: string): JQuery;
    tabs(options: JQueryUI.TabsOptions): JQuery;
    tabs(optionLiteral: string, optionName: string): any;
    tabs(optionLiteral: string, options: JQueryUI.TabsOptions): any;
    tabs(optionLiteral: string, optionName: string, optionValue: any): JQuery;

    tooltip(): JQuery;
    tooltip(methodName: 'destroy'): void;
    tooltip(methodName: 'disable'): void;
    tooltip(methodName: 'enable'): void;
    tooltip(methodName: 'open'): void;
    tooltip(methodName: 'close'): void;
    tooltip(methodName: 'widget'): JQuery;
    tooltip(methodName: string): JQuery;
    tooltip(options: JQueryUI.TooltipOptions): JQuery;
    tooltip(optionLiteral: string, optionName: string): any;
    tooltip(optionLiteral: string, options: JQueryUI.TooltipOptions): any;
    tooltip(optionLiteral: string, optionName: string, optionValue: any): JQuery;


    addClass(classNames: string, speed?: number, callback?: Function): JQuery;
    addClass(classNames: string, speed?: string, callback?: Function): JQuery;
    addClass(classNames: string, speed?: number, easing?: string, callback?: Function): JQuery;
    addClass(classNames: string, speed?: string, easing?: string, callback?: Function): JQuery;

    removeClass(classNames: string, speed?: number, callback?: Function): JQuery;
    removeClass(classNames: string, speed?: string, callback?: Function): JQuery;
    removeClass(classNames: string, speed?: number, easing?: string, callback?: Function): JQuery;
    removeClass(classNames: string, speed?: string, easing?: string, callback?: Function): JQuery;

    switchClass(removeClassName: string, addClassName: string, duration?: number, easing?: string, complete?: Function): JQuery;
    switchClass(removeClassName: string, addClassName: string, duration?: string, easing?: string, complete?: Function): JQuery;

    toggleClass(className: string, duration?: number, easing?: string, complete?: Function): JQuery;
    toggleClass(className: string, duration?: string, easing?: string, complete?: Function): JQuery;
    toggleClass(className: string, aswitch?: boolean, duration?: number, easing?: string, complete?: Function): JQuery;
    toggleClass(className: string, aswitch?: boolean, duration?: string, easing?: string, complete?: Function): JQuery;

    effect(options: any): JQuery;
    effect(effect: string, options?: any, duration?: number, complete?: Function): JQuery;
    effect(effect: string, options?: any, duration?: string, complete?: Function): JQuery;

    hide(options: any): JQuery;
    hide(effect: string, options?: any, duration?: number, complete?: Function): JQuery;
    hide(effect: string, options?: any, duration?: string, complete?: Function): JQuery;

    show(options: any): JQuery;
    show(effect: string, options?: any, duration?: number, complete?: Function): JQuery;
    show(effect: string, options?: any, duration?: string, complete?: Function): JQuery;

    toggle(options: any): JQuery;
    toggle(effect: string, options?: any, duration?: number, complete?: Function): JQuery;
    toggle(effect: string, options?: any, duration?: string, complete?: Function): JQuery;

    position(options: JQueryUI.JQueryPositionOptions): JQuery;

    enableSelection(): JQuery;
    disableSelection(): JQuery;
    focus(delay: number, callback?: Function): JQuery;
    uniqueId(): JQuery;
    removeUniqueId(): JQuery;
    scrollParent(): JQuery;
    zIndex(): JQuery;
    zIndex(zIndex: number): JQuery;

    widget: JQueryUI.Widget;

    jQuery: JQueryStatic;
}

interface JQueryStatic {
    ui: JQueryUI.UI;
    datepicker: JQueryUI.Datepicker;
    widget: JQueryUI.Widget;
    Widget: JQueryUI.Widget;
}// Type definitions for Knockout v3.2.0-beta
// Project: http://knockoutjs.com
// Definitions by: Boris Yankov <https://github.com/borisyankov/>, Igor Oleinikov <https://github.com/Igorbek/>
// Definitions: https://github.com/borisyankov/DefinitelyTyped


interface KnockoutSubscribableFunctions<T> {
    notifySubscribers(valueToWrite?: T, event?: string): void;
}

interface KnockoutComputedFunctions<T> {
}

interface KnockoutObservableFunctions<T> {
    equalityComparer(a: any, b: any): boolean;
}

interface KnockoutObservableArrayFunctions<T> {
    // General Array functions
    indexOf(searchElement: T, fromIndex?: number): number;
    slice(start: number, end?: number): T[];
    splice(start: number): T[];
    splice(start: number, deleteCount: number, ...items: T[]): T[];
    pop(): T;
    push(...items: T[]): void;
    shift(): T;
    unshift(...items: T[]): number;
    reverse(): T[];
    sort(): void;
    sort(compareFunction: (left: T, right: T) => number): void;

    // Ko specific
    replace(oldItem: T, newItem: T): void;

    remove(item: T): T[];
    remove(removeFunction: (item: T) => boolean): T[];
    removeAll(items: T[]): T[];
    removeAll(): T[];

    destroy(item: T): void;
    destroyAll(items: T[]): void;
    destroyAll(): void;
}

interface KnockoutSubscribableStatic {
    fn: KnockoutSubscribableFunctions<any>;

    new <T>(): KnockoutSubscribable<T>;
}

interface KnockoutSubscription {
    dispose(): void;
}

interface KnockoutSubscribable<T> extends KnockoutSubscribableFunctions<T> {
    subscribe(callback: (newValue: T) => void, target?: any, event?: string): KnockoutSubscription;
    subscribe<TEvent>(callback: (newValue: TEvent) => void, target: any, event: string): KnockoutSubscription;
    extend(requestedExtenders: { [key: string]: any; }): KnockoutSubscribable<T>;
    getSubscriptionsCount(): number;
}

interface KnockoutComputedStatic {
    fn: KnockoutComputedFunctions<any>;

    <T>(): KnockoutComputed<T>;
    <T>(func: () => T, context?: any, options?: any): KnockoutComputed<T>;
    <T>(def: KnockoutComputedDefine<T>, context?: any): KnockoutComputed<T>;
    (options?: any, context?: any): KnockoutComputed<any>;
}

interface KnockoutComputed<T> extends KnockoutObservable<T>, KnockoutComputedFunctions<T> {
    fn: KnockoutComputedFunctions<any>;

    dispose(): void;
    isActive(): boolean;
    getDependenciesCount(): number;
    extend(requestedExtenders: { [key: string]: any; }): KnockoutComputed<T>;
}

interface KnockoutObservableArrayStatic {
    fn: KnockoutObservableArrayFunctions<any>;

    <T>(value?: T[]): KnockoutObservableArray<T>;
}

interface KnockoutObservableArray<T> extends KnockoutObservable<T[]>, KnockoutObservableArrayFunctions<T> {
    extend(requestedExtenders: { [key: string]: any; }): KnockoutObservableArray<T>;
}

interface KnockoutObservableStatic {
    fn: KnockoutObservableFunctions<any>;

    <T>(value?: T): KnockoutObservable<T>;
}

interface KnockoutObservable<T> extends KnockoutSubscribable<T>, KnockoutObservableFunctions<T> {
    (): T;
    (value: T): void;

    peek(): T;
    valueHasMutated?:{(): void;};
    valueWillMutate?:{(): void;};
    extend(requestedExtenders: { [key: string]: any; }): KnockoutObservable<T>;
}

interface KnockoutComputedDefine<T> {
    read(): T;
    write? (value: T): void;
    disposeWhenNodeIsRemoved?: Node;
    disposeWhen? (): boolean;
    owner?: any;
    deferEvaluation?: boolean;
    pure?: boolean;
}

interface KnockoutBindingContext {
    $parent: any;
    $parents: any[];
    $root: any;
    $data: any;
    $index?: number;
    $parentContext?: KnockoutBindingContext;

    extend(properties: any): any;
    createChildContext(dataItemOrAccessor: any, dataItemAlias?: any, extendCallback?: Function): any;
}

interface KnockoutAllBindingsAccessor {
    (): any;
    get(name: string): any;
    has(name: string): boolean;
}

interface KnockoutBindingHandler {
    init? (element: any, valueAccessor: () => any, allBindingsAccessor: KnockoutAllBindingsAccessor, viewModel: any, bindingContext: KnockoutBindingContext): void;
    update? (element: any, valueAccessor: () => any, allBindingsAccessor: KnockoutAllBindingsAccessor, viewModel: any, bindingContext: KnockoutBindingContext): void;
    options?: any;
}

interface KnockoutBindingHandlers {
    [bindingHandler: string]: KnockoutBindingHandler;

    // Controlling text and appearance
    visible: KnockoutBindingHandler;
    text: KnockoutBindingHandler;
    html: KnockoutBindingHandler;
    css: KnockoutBindingHandler;
    style: KnockoutBindingHandler;
    attr: KnockoutBindingHandler;

    // Control Flow
    foreach: KnockoutBindingHandler;
    if: KnockoutBindingHandler;
    ifnot: KnockoutBindingHandler;
    with: KnockoutBindingHandler;

    // Working with form fields
    click: KnockoutBindingHandler;
    event: KnockoutBindingHandler;
    submit: KnockoutBindingHandler;
    enable: KnockoutBindingHandler;
    disable: KnockoutBindingHandler;
    value: KnockoutBindingHandler;
    hasfocus: KnockoutBindingHandler;
    checked: KnockoutBindingHandler;
    options: KnockoutBindingHandler;
    selectedOptions: KnockoutBindingHandler;
    uniqueName: KnockoutBindingHandler;

    // Rendering templates
    template: KnockoutBindingHandler;

    // Components (new for v3.2)
    component: KnockoutBindingHandler;
}

interface KnockoutMemoization {
    memoize(callback: () => string): string;
    unmemoize(memoId: string, callbackParams: any[]): boolean;
    unmemoizeDomNodeAndDescendants(domNode: any, extraCallbackParamsArray: any[]): boolean;
    parseMemoText(memoText: string): string;
}

interface KnockoutVirtualElement {}

interface KnockoutVirtualElements {
    allowedBindings: { [bindingName: string]: boolean; };
    emptyNode(node: KnockoutVirtualElement ): void;
    firstChild(node: KnockoutVirtualElement ): KnockoutVirtualElement;
    insertAfter( container: KnockoutVirtualElement, nodeToInsert: Node, insertAfter: Node ): void;
    nextSibling(node: KnockoutVirtualElement): Node;
    prepend(node: KnockoutVirtualElement, toInsert: Node ): void;
    setDomNodeChildren(node: KnockoutVirtualElement, newChildren: { length: number;[index: number]: Node; } ): void;
    childNodes(node: KnockoutVirtualElement ): Node[];
}

interface KnockoutExtenders {
    throttle(target: any, timeout: number): KnockoutComputed<any>;
    notify(target: any, notifyWhen: string): any;

    rateLimit(target: any, timeout: number): any;
    rateLimit(target: any, options: { timeout: number; method?: string; }): any;

    trackArrayChanges(target: any): any;
}

interface KnockoutUtils {

    //////////////////////////////////
    // utils.domManipulation.js
    //////////////////////////////////

    simpleHtmlParse(html: string): any[];

    jQueryHtmlParse(html: string): any[];

    parseHtmlFragment(html: string): any[];

    setHtml(node: Element, html: string): void;

    setHtml(node: Element, html: () => string): void;

    //////////////////////////////////
    // utils.domData.js
    //////////////////////////////////

    domData: {
        get (node: Element, key: string): any;

        set (node: Element, key: string, value: any): void;

        getAll(node: Element, createIfNotFound: boolean): any;

        clear(node: Element): boolean;
    };

    //////////////////////////////////
    // utils.domNodeDisposal.js
    //////////////////////////////////

    domNodeDisposal: {
        addDisposeCallback(node: Element, callback: Function): void;

        removeDisposeCallback(node: Element, callback: Function): void;

        cleanNode(node: Element): Element;

        removeNode(node: Element): void;
    };

    //////////////////////////////////
    // utils.js
    //////////////////////////////////

    fieldsIncludedWithJsonPost: any[];

    compareArrays<T>(a: T[], b: T[]): Array<KnockoutArrayChange<T>>;

    arrayForEach<T>(array: T[], action: (item: T) => void): void;

    arrayIndexOf<T>(array: T[], item: T): number;

    arrayFirst<T>(array: T[], predicate: (item: T) => boolean, predicateOwner?: any): T;

    arrayRemoveItem(array: any[], itemToRemove: any): void;

    arrayGetDistinctValues<T>(array: T[]): T[];

    arrayMap<T, U>(array: T[], mapping: (item: T) => U): U[];

    arrayFilter<T>(array: T[], predicate: (item: T) => boolean): T[];

    arrayPushAll<T>(array: T[], valuesToPush: T[]): T[];

    arrayPushAll<T>(array: KnockoutObservableArray<T>, valuesToPush: T[]): T[];

    extend(target: Object, source: Object): Object;

    emptyDomNode(domNode: HTMLElement): void;

    moveCleanedNodesToContainerElement(nodes: any[]): HTMLElement;

    cloneNodes(nodesArray: any[], shouldCleanNodes: boolean): any[];

    setDomNodeChildren(domNode: any, childNodes: any[]): void;

    replaceDomNodes(nodeToReplaceOrNodeArray: any, newNodesArray: any[]): void;

    setOptionNodeSelectionState(optionNode: any, isSelected: boolean): void;

    stringTrim(str: string): string;

    stringTokenize(str: string, delimiter: string): string[];

    stringStartsWith(str: string, startsWith: string): string;

    domNodeIsContainedBy(node: any, containedByNode: any): boolean;

    domNodeIsAttachedToDocument(node: any): boolean;

    tagNameLower(element: any): string;

    registerEventHandler(element: any, eventType: any, handler: Function): void;

    triggerEvent(element: any, eventType: any): void;

    unwrapObservable<T>(value: KnockoutObservable<T>): T;

    peekObservable<T>(value: KnockoutObservable<T>): T;

    toggleDomNodeCssClass(node: any, className: string, shouldHaveClass: boolean): void;

    //setTextContent(element: any, textContent: string): void; // NOT PART OF THE MINIFIED API SURFACE (ONLY IN knockout-{version}.debug.js) https://github.com/SteveSanderson/knockout/issues/670

    setElementName(element: any, name: string): void;

    forceRefresh(node: any): void;

    ensureSelectElementIsRenderedCorrectly(selectElement: any): void;

    range(min: any, max: any): any;

    makeArray(arrayLikeObject: any): any[];

    getFormFields(form: any, fieldName: string): any[];

    parseJson(jsonString: string): any;

    stringifyJson(data: any, replacer?: Function, space?: string): string;

    postJson(urlOrForm: any, data: any, options: any): void;

    ieVersion: number;

    isIe6: boolean;

    isIe7: boolean;
}

interface KnockoutArrayChange<T> {
    status: string;
    value: T;
    index: number;
}

//////////////////////////////////
// templateSources.js
//////////////////////////////////

interface KnockoutTemplateSourcesDomElement {
    text(): any;
    text(value: any): void;

    data(key: string): any;
    data(key: string, value: any): any;
}

interface KnockoutTemplateAnonymous extends KnockoutTemplateSourcesDomElement {
    nodes(): any;
    nodes(value: any): void;
}

interface KnockoutTemplateSources {

    domElement: {
        prototype: KnockoutTemplateSourcesDomElement
        new (element: Element): KnockoutTemplateSourcesDomElement
    };

    anonymousTemplate: {
        prototype: KnockoutTemplateAnonymous;
        new (element: Element): KnockoutTemplateAnonymous;
    };
}

//////////////////////////////////
// nativeTemplateEngine.js
//////////////////////////////////

interface KnockoutNativeTemplateEngine {

    renderTemplateSource(templateSource: Object, bindingContext?: KnockoutBindingContext, options?: Object): any[];
}

//////////////////////////////////
// templateEngine.js
//////////////////////////////////

interface KnockoutTemplateEngine extends KnockoutNativeTemplateEngine {

    createJavaScriptEvaluatorBlock(script: string): string;

    makeTemplateSource(template: any, templateDocument?: Document): any;

    renderTemplate(template: any, bindingContext: KnockoutBindingContext, options: Object, templateDocument: Document): any;

    isTemplateRewritten(template: any, templateDocument: Document): boolean;

    rewriteTemplate(template: any, rewriterCallback: Function, templateDocument: Document): void;
}

/////////////////////////////////

interface KnockoutStatic {
    utils: KnockoutUtils;
    memoization: KnockoutMemoization;

    bindingHandlers: KnockoutBindingHandlers;
    getBindingHandler(handler: string): KnockoutBindingHandler;

    virtualElements: KnockoutVirtualElements;
    extenders: KnockoutExtenders;

    applyBindings(viewModel: any, rootNode?: any): void;
    applyBindingsToDescendants(viewModel: any, rootNode: any): void;
    applyBindingAccessorsToNode(node: Node, bindings: (bindingContext: KnockoutBindingContext, node: Node) => {}, bindingContext: KnockoutBindingContext): void;
    applyBindingAccessorsToNode(node: Node, bindings: {}, bindingContext: KnockoutBindingContext): void;
    applyBindingAccessorsToNode(node: Node, bindings: (bindingContext: KnockoutBindingContext, node: Node) => {}, viewModel: any): void;
    applyBindingAccessorsToNode(node: Node, bindings: {}, viewModel: any): void;
    applyBindingsToNode(node: Element, options: any, viewModel: any): void;

    subscribable: KnockoutSubscribableStatic;
    observable: KnockoutObservableStatic;

    computed: KnockoutComputedStatic;
    pureComputed<T>(evaluatorFunction: () => T, context?: any): KnockoutComputed<T>;
    pureComputed<T>(options: KnockoutComputedDefine<T>, context?: any): KnockoutComputed<T>;

    observableArray: KnockoutObservableArrayStatic;

    contextFor(node: any): any;
    isSubscribable(instance: any): boolean;
    toJSON(viewModel: any, replacer?: Function, space?: any): string;
    toJS(viewModel: any): any;
    isObservable(instance: any): boolean;
    isWriteableObservable(instance: any): boolean;
    isComputed(instance: any): boolean;
    dataFor(node: any): any;
    removeNode(node: Element): void;
    cleanNode(node: Element): Element;
    renderTemplate(template: Function, viewModel: any, options?: any, target?: any, renderMode?: any): any;
    renderTemplate(template: string, viewModel: any, options?: any, target?: any, renderMode?: any): any;
    unwrap(value: any): any;

    computedContext: KnockoutComputedContext;

    //////////////////////////////////
    // templateSources.js
    //////////////////////////////////

    templateSources: KnockoutTemplateSources;

    //////////////////////////////////
    // templateEngine.js
    //////////////////////////////////

    templateEngine: {

        prototype: KnockoutTemplateEngine;

        new (): KnockoutTemplateEngine;
    };

    //////////////////////////////////
    // templateRewriting.js
    //////////////////////////////////

    templateRewriting: {

        ensureTemplateIsRewritten(template: Node, templateEngine: KnockoutTemplateEngine, templateDocument: Document): any;
        ensureTemplateIsRewritten(template: string, templateEngine: KnockoutTemplateEngine, templateDocument: Document): any;

        memoizeBindingAttributeSyntax(htmlString: string, templateEngine: KnockoutTemplateEngine): any;

        applyMemoizedBindingsToNextSibling(bindings: any, nodeName: string): string;
    };

    //////////////////////////////////
    // nativeTemplateEngine.js
    //////////////////////////////////

    nativeTemplateEngine: {

        prototype: KnockoutNativeTemplateEngine;

        new (): KnockoutNativeTemplateEngine;

        instance: KnockoutNativeTemplateEngine;
    };

    //////////////////////////////////
    // jqueryTmplTemplateEngine.js
    //////////////////////////////////

    jqueryTmplTemplateEngine: {

        prototype: KnockoutTemplateEngine;

        renderTemplateSource(templateSource: Object, bindingContext: KnockoutBindingContext, options: Object): Node[];

        createJavaScriptEvaluatorBlock(script: string): string;

        addTemplate(templateName: string, templateMarkup: string): void;
    };

    //////////////////////////////////
    // templating.js
    //////////////////////////////////

    setTemplateEngine(templateEngine: KnockoutNativeTemplateEngine): void;

    renderTemplate(template: Function, dataOrBindingContext: KnockoutBindingContext, options: Object, targetNodeOrNodeArray: Node, renderMode: string): any;
    renderTemplate(template: any, dataOrBindingContext: KnockoutBindingContext, options: Object, targetNodeOrNodeArray: Node, renderMode: string): any;
    renderTemplate(template: Function, dataOrBindingContext: any, options: Object, targetNodeOrNodeArray: Node, renderMode: string): any;
    renderTemplate(template: any, dataOrBindingContext: any, options: Object, targetNodeOrNodeArray: Node, renderMode: string): any;
    renderTemplate(template: Function, dataOrBindingContext: KnockoutBindingContext, options: Object, targetNodeOrNodeArray: Node[], renderMode: string): any;
    renderTemplate(template: any, dataOrBindingContext: KnockoutBindingContext, options: Object, targetNodeOrNodeArray: Node[], renderMode: string): any;
    renderTemplate(template: Function, dataOrBindingContext: any, options: Object, targetNodeOrNodeArray: Node[], renderMode: string): any;
    renderTemplate(template: any, dataOrBindingContext: any, options: Object, targetNodeOrNodeArray: Node[], renderMode: string): any;

    renderTemplateForEach(template: Function, arrayOrObservableArray: any[], options: Object, targetNode: Node, parentBindingContext: KnockoutBindingContext): any;
    renderTemplateForEach(template: any, arrayOrObservableArray: any[], options: Object, targetNode: Node, parentBindingContext: KnockoutBindingContext): any;
    renderTemplateForEach(template: Function, arrayOrObservableArray: KnockoutObservable<any>, options: Object, targetNode: Node, parentBindingContext: KnockoutBindingContext): any;
    renderTemplateForEach(template: any, arrayOrObservableArray: KnockoutObservable<any>, options: Object, targetNode: Node, parentBindingContext: KnockoutBindingContext): any;

    expressionRewriting: {
        bindingRewriteValidators: any;
    };

    /////////////////////////////////

    bindingProvider: {
        instance: KnockoutBindingProvider;
        new (): KnockoutBindingProvider;
    }

    /////////////////////////////////
    // selectExtensions.js
    /////////////////////////////////

    selectExtensions: {

        readValue(element: HTMLElement): any;

        writeValue(element: HTMLElement, value: any): void;
    };
}

interface KnockoutBindingProvider {
    nodeHasBindings(node: Node): boolean;
    getBindings(node: Node, bindingContext: KnockoutBindingContext): {};
    getBindingAccessors?(node: Node, bindingContext: KnockoutBindingContext): { [key: string]: string; };
}

interface KnockoutComponents {
    register(componentName: string, definition: KnockoutComponentDefinition): void;
    isRegistered(componentName: string): boolean;
    unregister(componentName: string): void;
    get(componentName: string, callback: (definition: KnockoutComponentDefinition) => void): void;
    clearCachedDefinition(componentName: string): void
    defaultLoader: KnockoutComponentLoader;
    loaders: KnockoutComponentLoader[];
    getComponentNameForNode(node: Node): string;
}

interface KnockoutComponentDefinition {
    template: Node[];
    createViewModel?(params: any, options: { element: Node; }): any;
}

interface KnockoutComponentLoader {
    getConfig? (componentName: string, callback: (result: KnockoutComponentConfig) => void): void;
    loadComponent? (componentName: string, config: KnockoutComponentConfig, callback: (result: KnockoutComponentDefinition) => void): void;
    loadTemplate? (componentName: string, templateConfig: any, callback: (result: Node[]) => void): void;
    loadViewModel? (componentName: string, viewModelConfig: any, callback: (result: any) => void): void;
    suppressLoaderExceptions?: boolean;
}

interface KnockoutComponentConfig {
    template: any;
    createViewModel?: any;
}

interface KnockoutComputedContext {
    getDependenciesCount(): number;
    isInitial: boolean;
    isSleeping: boolean;
}

declare module "knockout" {
    export = ko;
}

declare var ko: KnockoutStatic;interface Object {
    keysAt(o: Object, index: number): string;
    _keys(o: Object, index?: number): any;
    keys(o: Object): string[];
    values(o: Object): any[];
    findBy(o: Object, field: string, value: any): any;
    findManyBy(o: Object, field: string, value: any): any[];
    hasKeys(o: Object): boolean;
    toJson(o: Object): Object;
}
interface String {
    lPad(pchar: string, length: number): any;
    rPad(pchar: string, length: number): any;
    toHex(): string;
    startsWith(str: string): boolean;
    endsWith(str: string): boolean;
    replaceAll(strToReplace: string, str: string): string;
    left(len: number): string;
    right(len: number): string;
    RTrim(value?: string): string;
    LTrim(value?: string): string;
    format(...args: any[]): string;
    random(n?: number): string;
    shake(): string;
    text(allowed?: string): string;
    toProperCase(): string;
    contains(str: string): boolean;
}
interface StringConstructor {
    generate(n?: number): string;
    format(str: string, ...args: any[]): string;
}
declare function sprintf(str: string, ...args: any[]): string;
interface Date {
    getUTCTime(): number;
    getTimeAge(d?: Date, i?: string, o?: any): number;
    getYearAge(d?: Date): number;
    getMonthAge(d?: Date): number;
    add(i: string, n: number): void;
    addMonth(n: number): void;
    addYear(n: number): void;
    addDate(n: number): void;
    isPast(d?: Date): boolean;
    isFuture(d?: Date): boolean;
    isToday(): boolean;
    getAge(d?: Date): any;
    isNow(): boolean;
    isSameDate(d?: Date): boolean;
}
interface Array<T> {
    indexOfStr(elt: T, from?: number): number;
    remove(o: T): T;
    removeAt(index: number): T;
    removeAll(l?: T[]): T[];
    clear(): T[];
    pushOnce(elt: T, caseSensitive?: boolean): boolean;
    findBy(field: string, value: any, from?: number): T;
    findManyBy(field: string, value: any, from?: number): T[];
    union(o: any[]): any[];
    fusion(o: any): any[];
    get(ind: number): T;
    contains(o: T): boolean;
    contains(o: T[]): boolean;
    union(o: T[]): T[];
    first(): T;
    last(): T;
    equals(ary: T[]): boolean;
    shake(): T[];
}
interface Number {
    round(decimal?: number): number;
}
declare module kit.utils {
    /**
     * Clones the given instance.
     * @param {*} srcInstance An instance.
     * @return {*} The clone of the given instance.
     */
    function clone(srcInstance: any): any;
    function getElementText(element: any): string;
    function formatEmail(email: string): string;
    /**
     * Format a string by replacing argument expressed inside curly brackets with given arguments
     * Search occurences of a pattern of the form ${XXXX} or $XXX with the dolar sign not escaped
     * @return a formatted string
     */
    function formatString(str: string, parameters: any): string;
    function flattenObject(object: any): any;
    /**
     * Parse a given log message
     * log message MUST respect the following format
     *
     * 			var log_message = "log_id {param1:value1}{param2:value2}{param3:value3}"
     *
     * @param a log message as described above
     *
     * @return an object containing the log id and another object for the parameters
     * that contains for each param id, its associated value.
     */
    function parseLogMessage(logMessage: any): any;
    /**
     * Parse a given log message which has the following syntax :
     * {"errorCode":0,"errorMessage":"<ID><{P}>*"}
     * <ID> should be a valid message id present in the internationalization excel file.
     * <{P}>* is the paramters which are not translated.
     *
     * example : {"errorCode":0,"errorMessage":"blabla{parameter1}{parameter2}"}
     *
     * @param a log message
     * @return the internationalized string constructed from the id and the parameters contained
     * in the logMessage string.
     */
    function getInternationalizedLogMessage(logMessage: any): string;
    function getParamValue(param: string, url?: string): string;
    function formatMonthToYear(PE_nbMonth: number, strict?: boolean): string;
    /**
     * format dates
     * @param dateFormat the date format defines in local index
     * @return a formatted string date in the "dateFormat" format
     */
    function formatDate(d: Date, dateFormat: string, hourFormat?: string, utc?: boolean): string;
    /**
    * Traite et converti une chaine. La valeur peut être modifiée pour correspondre à une valeur date.
    * Renvoi un objet Calendar contenant la chaine traitée.
    *
    * @param string	La chaine
    * @param locale 	La locale utilisée
    */
    function parseLiteralDate(str: string, locale: Locale): Date;
    function formatDecimal(str: any, digits?: number, locale?: Locale): string;
    function genId(l?: number): string;
}
declare module kit.regexp {
    var CdPost: RegExp;
    var Email: RegExp;
    var AlphaNumerique: RegExp;
    var Alpha: RegExp;
    var Adresse: RegExp;
    var Mots: RegExp;
    var Integer: RegExp;
    var PositiveInteger: RegExp;
    var Double: RegExp;
    var PositiveDouble: RegExp;
    var NumTel: RegExp;
    var NumTelEtendu: RegExp;
    var NumTelPermissif: RegExp;
    var NumDossier: RegExp;
}
interface JQuery {
    ajaxForm: Function;
    crypt: Function;
    tooltipster: Function;
    appear: Function;
    nanoScroller: Function;
}
interface JQueryStatic {
    address: any;
    url: Function;
    cookie: Function;
    cookieBar: Function;
}
interface KnockoutStatic {
    linkObservableToUrl: any;
}
interface KnockoutUtils {
    isObservableArray(obj: any): boolean;
    dispose(obj: any): void;
}
interface KnockoutObservableArrayFunctions<T> {
    filterByProperty(propName: string, matchValue: string): KnockoutObservableArray<T>;
    clear(): T[];
}
interface KnockoutSubscribable<T> {
    (value?: any): any;
    subscribeOnce(callback: Function, context?: any, eventName?: string): KnockoutSubscription;
    immediateSubscribe(callback: Function, context?: any, eventName?: string): KnockoutSubscription;
    dependsOn(observable: KnockoutSubscribable<any>, fn?: Function, ope?: number): KnockoutSubscription;
    makeTrueIfNot(observable: KnockoutSubscribable<any>, ope?: number): KnockoutSubscription;
}
interface IDisposable {
    dispose(): void;
}
interface IApplicationContext {
    device: string;
    page: string;
}
interface IEventsBinder {
    on(eventId: any, callback: Function, context?: any): void;
    emit(...args: any[]): void;
}
interface IApplication extends IEventsBinder {
    title: KnockoutObservable<string>;
    i18n: kit.manager.I18n;
    browser: kit.helpers.Browser;
    manager: kit.AppManager;
    userData: any;
    webkitPath: string;
    webkitLogUri: string;
    basePath: string;
    servicesPath: string;
    useDialog: boolean;
    version: string;
    logLevel: number;
    logConsole: boolean;
    onAjaxSend: Function;
    getFinalFileName(fileName: string): string;
    navigateTo(href: string): void;
    context: IApplicationContext;
    isReady: KnockoutObservable<boolean>;
    ready(fn: Function, context?: any): void;
    init(userData?: any): void;
    mailto(data: any): void;
    postRedirect(url: string, data_post: any, target?: string, data_get?: any): void;
}
interface Window {
    app: IApplication;
    vm: any;
}
declare function isNaN(o: any): boolean;
declare var app: IApplication;
declare var browserLocaleInfos: any;
declare function isset(value: any): boolean;
declare function defer(fn: Function, delay?: number, context?: any): number;
declare function fire(fn: any, args?: any): void;
/**
*
* @param value
* @param nbdec
* @return
*/
declare function round(value: any, nbdec?: number): number;
/**
*
*/
declare function CString(obj: any): string;
/**
*
*/
declare function CFloat(obj: any, rnd?: number): number;
declare function CNumber(obj: any, rnd?: number): number;
/**
*
*/
declare function CInt(obj: any): number;
/**
*
* @param obj
* @return
*/
declare function is_string(obj: any): boolean;
/**
*
* @param obj
* @return
*/
declare function is_numeric(obj: any): boolean;
declare function dispose(obj: Object): void;
declare module kit {
    function alert(text: string, callbackAlert?: any, opts?: ui.IMessageBoxOptions): ui.MessageBox;
    function confirm(text: string, callbackOk?: Function, callbackCancel?: any, opts?: ui.IMessageBoxOptions): ui.MessageBox;
}
/**
 * @fileOverview This file defines the errors module.
 * @example var _errorsHelper = oneesp.module('commons.helper.errors');
 */
declare module kit.helpers {
    /**
     * MODES
     * @enum {int}
     * @memberOf oneesp.module.commons.helper.errors#
     */
    enum TLogLevel {
        TRACE = 0,
        DEBUG = 1,
        INFO = 2,
        WARN = 3,
        ERROR = 4,
        FATAL = 5,
    }
    interface ILogAppender {
        level: TLogLevel;
        log(className: string, level: TLogLevel, text: string, e?: any, date?: Date): void;
    }
    class Appender {
        level: TLogLevel;
        formatMessage(className: string, date: Date, level: TLogLevel, message: string): string;
        constructor(level?: TLogLevel);
    }
    class ConsoleAppender extends Appender implements ILogAppender {
        constructor();
        log(className: string, level: TLogLevel, message: string, exception?: any, date?: Date): void;
    }
    class RemoteAppender extends Appender implements ILogAppender {
        url: string;
        constructor(url: string);
        log(className: string, level: TLogLevel, message: string, exception?: any, date?: Date): void;
    }
    class Logger {
        static loggers: any;
        appenders: ILogAppender[];
        /**
         * The current mode
         * @name mode
         * @type observable
         * @defaultValue Modes.DEVELOPMENT
         * @memberOf oneesp.module.commons.helper.errors#
         */
        level: KnockoutObservable<TLogLevel>;
        id: string;
        constructor(id: string, level?: TLogLevel);
        isTraceEnabled(): boolean;
        isInfoEnabled(): boolean;
        isDebugEnabled(): boolean;
        isWarnEnabled(): boolean;
        info(text: string, e?: any): void;
        warn(text: string, e?: any): void;
        trace(text: string, e?: any): void;
        debug(text: string, e?: any): void;
        error(text: string, e?: any): void;
        fatal(text: string, e?: any): void;
        log(className: string, level: TLogLevel, message: string, exception?: any, date?: Date): void;
        addAppender(appender: ILogAppender): void;
        /** return logger
         * @param {string} className
         */
        static getLogger(className: string): Logger;
        static getDefaultLogger(): Logger;
        static getConsoleAppender(): ILogAppender;
    }
}
/**
 * @fileOverview This file defines the query module.
 * @example var _queryHelper = oneesp.module('commons.helper.query');
 * @example var _queryHelper = oneesp.module('commons.helper.query').helper({ domain: APPLICATION_ID });
 */
declare module kit.helpers {
    interface IQueryOptions {
        silent?: boolean;
        delay?: number;
        dataType?: string;
        contentType?: any;
        async?: boolean;
        timeout?: number;
        domain?: string;
        cache?: boolean;
        upToDate?: boolean;
        headers?: any;
    }
    interface IQueryRequest {
        ID: number;
        method: string;
        url: string;
        data: any;
        callbacks: any;
        context: any;
        options: IQueryOptions;
        startedAt: number;
    }
    interface IQueryCallbacks {
        success?: Function;
        fail?: Function;
        complete?: Function;
    }
    class Query {
        static defaultOptions: IQueryOptions;
        static DEFAULT_DELAY: number;
        /** The number of current queries processed
         * @name nbQueries
         * @readonly
         * @type observable
         * @memberOf oneesp.module.commons.helper.query#
         */
        static nbQueries: KnockoutObservable<number>;
        /** Return if a query is running
         * @name isBusy
         * @readonly
         * @type observable
         * @memberOf oneesp.module.commons.helper.query#
         */
        static isBusy: KnockoutObservable<boolean>;
        /** Return if the socket is disconnected
         * @name isDisconnected
         * @readonly
         * @type observable
         * @memberOf oneesp.module.commons.helper.query#
         */
        static isDisconnected: KnockoutObservable<boolean>;
        /** Return if the module is locked. When it is locked, no query will be sent.
         * @name isLocked
         * @type observable
         * @memberOf oneesp.module.commons.helper.query#
         * @example _queryHelper.isLocked(true); //Do lock
         * @example _queryHelper.isLocked(true); //Unlock
         */
        static isLocked: KnockoutObservable<boolean>;
        /** Return the current stack of requests
         * @memberOf oneesp.module.commons.helper.query#
         * @returns {array}
         */
        static getCurrentStackRequests(): {
            [key: string]: IQueryRequest;
        };
        /** The status codes
         * @readonly
         * @enum {string}
         * @memberOf oneesp.module.commons.helper.query#
         */
        static Status: {
            SUCCESS: string;
            ERROR: string;
            ABORT: string;
            NOCONTENT: string;
            TIMEOUT: string;
        };
        /** The methods
         * @readonly
         * @enum {string}
         * @memberOf oneesp.module.commons.helper.query#
         */
        static Methods: {
            PUT: string;
            PATCH: string;
            GET: string;
            POST: string;
            DELETE: string;
        };
        /** The states
         * @readonly
         * @enum {string}
         * @memberOf oneesp.module.commons.helper.query#
         */
        static States: {
            REJECTED: string;
        };
        id: string;
        opts: IQueryOptions;
        constructor(id: string, opts?: IQueryOptions);
        /**
         * Send a PUT request
         * @method PUT
         * @param {string} url
         * @param {string} data
         * @param {function} callbacks
         * @param {object} context
         * @param {IQueryOptions} opts
         * @returns {object} jQuery handler
         * @memberOf oneesp.module.commons.helper.query.Helper
         */
        PUT(url: string, data: any, callbacks: any, context?: any, opts?: IQueryOptions): JQueryXHR;
        /**
        * GET
        * @method GET
        * @param {string} url
        * @param {function} callbacks
        * @param {object} context
        * @param {object} opts
        * @returns {object} jQuery handler
        * @memberOf oneesp.module.commons.helper.query.Helper
        */
        GET(url: string, callbacks: any, context?: any, opts?: IQueryOptions): JQueryXHR;
        /**
        * GETasJson
        * @method GETasJson
        * @param {string} url
        * @param {function} callbacks
        * @param {object} context
        * @param {object} opts
        * @returns {object} jQuery handler
        * @memberOf oneesp.module.commons.helper.query.Helper
        */
        GETasJson: (url: string, callbacks: any, context?: any, opts?: IQueryOptions) => JQueryXHR;
        /**
        * POST
        * @method POST
        * @param {string} url
        * @param {string} data
        * @param {function} callbacks
        * @param {object} context
        * @param {object} opts
        * @returns {object} jQuery handler
        * @memberOf oneesp.module.commons.helper.query.Helper
        */
        POST(url: string, data: any, callbacks: any, context?: any, opts?: IQueryOptions): JQueryXHR;
        /**
        * DELETE
        * @method DELETE
        * @param {string} url
        * @param {function} callbacks
        * @param {object} context
        * @param {object} opts
        * @returns {object} jQuery handler
        * @memberOf oneesp.module.commons.helper.query.Helper
        */
        DELETE(url: string, callbacks: any, context?: any, opts?: IQueryOptions): JQueryXHR;
        private mergeOptions(opts);
        /**
         * Return an helper
         * @param {string} id - The id  (optional)
         * @param {IQueryOptions} opts - The options
         * @returns {Query}
         * @memberOf oneesp.module.commons.helper.query#
         * @example queryHelper.helper('MyHelper', { domain true});
         * @example queryHelper.helper({ domain true});
         */
        static create(opts?: IQueryOptions): Query;
        /**
         * Send a query request from HTML form
         * @param {function} callbacks - The callback function
         * @param {object} context - The context
         * @param {object} opts - The options
         * @returns {object} jQuery handler
         */
        static queryFormData(form: HTMLFormElement, callbacks?: any, context?: any, opts?: IQueryOptions): JQueryXHR;
        /** Send a query request
         * @param {Methods} method - The http method
         * @param {string} url - The url to call
         * @param {string} data - The data to send
         * @param {function} callbacks - The callback function
         * @param {object} context - The context
         * @param {object} opts - The options
         * @returns {object} jQuery handler
         */
        static query(method: string, url: string, data: any, callbacks?: any, context?: any, opts?: IQueryOptions): JQueryXHR;
        /** Send a PUT request
         * @param {string} url - The url to call
         * @param {string} data - The data to send
         * @param {function} callbacks - The callback function
         * @param {object} context - The context
         * @param {object} opts - The options
         * @returns {object} jQuery handler
         * @memberOf oneesp.module.commons.helper.query#
         */
        static PUT(url: string, data: any, callbacks: any, context?: any, opts?: IQueryOptions): JQueryXHR;
        /** Send a PATCH request
         * @param {string} url - The url to call
         * @param {string} data - The data to send
         * @param {function} callbacks - The callback function
         * @param {object} context - The context
         * @param {object} opts - The options
         * @returns {object} jQuery handler
         * @memberOf oneesp.module.commons.helper.query#
         */
        static PATCH(url: string, data: any, callbacks: any, context?: any, opts?: IQueryOptions): JQueryXHR;
        /** Send a GET request
         * @param {string} url - The url to call
         * @param {function} callbacks - The callback function
         * @param {object} context - The context
         * @param {object} opts - The options
         * @returns {object} jQuery handler
         * @memberOf oneesp.module.commons.helper.query#
         */
        static GET(url: string, callbacks: any, context?: any, opts?: IQueryOptions): JQueryXHR;
        /** Send a GET request and get a json object as result
         * @param {string} url - The url to call
         * @param {function} callbacks - The callback function
         * @param {object} context - The context
         * @param {object} opts - The options
         * @returns {object} jQuery handler
         * @memberOf oneesp.module.commons.helper.query#
         */
        static GETasJson(url: string, callbacks: any, context?: any, opts?: IQueryOptions): JQueryXHR;
        /** Send a POST request
         * @param {string} url - The url to call
         * @param {string} data - The data to send
         * @param {function} callbacks - The callback function
         * @param {object} context - The context
         * @param {object} opts - The options
         * @returns {object} jQuery handler
         * @memberOf oneesp.module.commons.helper.query#
         */
        static POST(url: string, data: any, callbacks: any, context?: any, opts?: IQueryOptions): JQueryXHR;
        /** Send a DELETE request
         * @param {string} url - The url to call
         * @param {function} callbacks - The callback function
         * @param {object} context - The context
         * @param {object} opts - The options
         * @returns {object} jQuery handler
         * @memberOf oneesp.module.commons.helper.query#
         */
        static DELETE(url: string, callbacks: any, context?: any, opts?: IQueryOptions): JQueryXHR;
    }
}
/**
 * @fileOverview This file defines the storage module
 */
declare module kit.helpers {
    interface IStorageOptions {
        crypt?: boolean;
    }
    class Storage {
        static put(name: string, value: any, opts?: IStorageOptions): boolean;
        static putObject(name: string, json: any, opts?: IStorageOptions): boolean;
        static read(name: string, opts?: IStorageOptions): string;
        static remove(name: any): boolean;
        static readAsObject(name: string, opts?: IStorageOptions): Object;
        static readAsNumber(name: string, opts?: IStorageOptions): number;
    }
}
/**
 * @fileOverview This file defines the browser support
 */
declare module kit.helpers {
    var getBrowserLanguage: () => string;
    class BrowserInfo {
        browser: string;
        version: number;
        OS: string;
        language: string;
        countryCode: string;
        private versionSearchString;
        constructor();
        /** Détermine si on est PROBABLEMENT sur la version ModernUI (on ne peut pas en être sûr, merci Microsoft) */
        isProbablyModernUI(): boolean;
        private searchString(data);
        private searchVersion(dataString);
    }
}
/**
 * @fileOverview This file defines the browser support
 */
declare module kit.helpers {
    interface ISupportedBrowserInfo {
        name: string;
        minVersion: number;
    }
    class Browser {
        currentBrowserInfos: BrowserInfo;
        private supportedVersions;
        constructor(supportedVersions?: ISupportedBrowserInfo[]);
        setSupportedVersions(supportedVersions: ISupportedBrowserInfo[]): void;
        /**
         * Retourne les informations issues du browser
         */
        getCurrentBrowserInfos(): BrowserInfo;
        /**
         * Contrôle le navigateur et la version min par rapport aux informations du browser
         */
        check(fn?: Function): boolean;
        /**
         * Contrôle le navigateur et la version min par rapport aux informations passées en parametres
         */
        checkForBrowser(browserName: string, version: number, fn?: Function): boolean;
    }
}
/**
 * @fileOverview This file defines the files manager.
 */
declare module kit.helpers {
    function loadResource(resource: string, callback: Function, context?: any): void;
}
/**
 * @fileOverview This file defines a simple xml to json converter.
 */
declare module kit.helpers {
    class XmlConverter {
        static ATTRIBUTES_KEY: string;
        /**
         * Converts XML to JSON.
         */
        static toJson(xml: Node): any;
    }
}
declare module kit {
    class Locale {
        decimalGroupSeparator: string;
        decimalGroupDigits: number;
        decimalSeparator: string;
        dateFormat: string;
        dateSeparator: string;
        dateLiteralFormat: string;
        currencySymbol: string;
        displayName: string;
        private language;
        private isoCode;
        constructor(language: string, isoCode: string);
        getLang(): string;
        getIsoCode(): string;
    }
}
declare module kit {
    class AppManager {
        private _managers;
        private _binders;
        private _isRunningLock;
        private _unsynchronized;
        private checkBinders();
        register(managerId: string, manager: BaseManager): BaseManager;
        exists(managerId: string): BaseManager;
        get(managerId: string): BaseManager;
        getManagers(): any;
        private addBinder(managerId, fn, context, ifReady);
        ready(managerId: any, fn: Function, context?: any): void;
        require(managerId: any, fn: Function, context?: any): void;
    }
}
declare module kit {
    interface IEvent {
        id: string;
        arguments: any;
    }
    class EventsBinder implements IEventsBinder, IDisposable {
        private __event__;
        private __subscriptions__;
        on(eventId: any, callback: Function, context?: any): void;
        emit(...args: any[]): void;
        clearSubscriptions(): void;
        dispose(): void;
    }
}
declare module kit {
    var inherits: Function;
    /**
     * A module.
     */
    class BaseManager extends EventsBinder {
        executionContext: any;
        private _domains;
        private _domainCounter;
        /**
        * A value that indicates whether this module is ready.
        * @type {ko.observable(boolean)}
        */
        isReady: KnockoutObservable<boolean>;
        constructor();
        init(): void;
        /**
         * Executes the given callback when this module is ready.
         * @param callback The function to execute when this module is ready.
         * @param context The context for the given callback.
         */
        ready(callback: Function, context?: any): boolean;
    }
}
declare module kit {
    class ViewModel extends EventsBinder implements IDisposable {
        private _bindings;
        strings: any;
        constructor(stringsToRegister: string[]);
        addStringToModel(id: string): void;
        addStringsToModel(ids: string[]): void;
        dispose(): void;
        applyBindings(element: string, bindings: string): any;
        applyBindings(element: JQuery, bindings?: string): any;
        applyBindings(element: string, bindings?: any): any;
        applyBindings(element: JQuery, bindings?: any): any;
        removeBindings(element: string): any;
        removeBindings(element: JQuery): any;
        clearBindings(): void;
    }
}
declare module kit {
    class ResponsiveViewModel extends ViewModel {
        normalWidth: number;
        tabletWidth: number;
        isMobile: KnockoutObservable<boolean>;
        isTablet: KnockoutObservable<boolean>;
        isNormal: KnockoutObservable<boolean>;
        constructor(stringsToRegister: string[]);
    }
}
declare module kit {
    class MVVM extends ViewModel {
        /**
         * The content encapsulated in this view.
         * @type {jQuery.Object}
         */
        private htmlContent;
        private content;
        private owner;
        private view;
        loadingState: KnockoutObservable<boolean>;
        isLoaded: KnockoutObservable<boolean>;
        isLoading: KnockoutObservable<boolean>;
        constructor(view: string, stringsToRegister?: string[]);
        private _load(htmlContent, callback?);
        load(callback?: Function, htmlContent?: string): void;
        loadTo(owner: string, callback?: Function): void;
        beforePrepare(): void;
        afterPrepare(): void;
        prepare(): void;
        unload(): void;
        _unload(): void;
        dispose(): void;
        getContent(): JQuery;
        getView(): string;
    }
}
declare module kit {
    interface IDialogOptions {
        zIndex?: number;
        height?: string;
        width?: string;
        resizable?: boolean;
        draggable?: boolean;
        modal?: boolean;
        dialogClass?: string;
    }
    /** Predefined buttons to show
     * @alias Button
     * @enum {string}
     * @example _messageBox.Button.OkCancel;
     */
    var TDialogButtons: {
        Ok: string;
        OkCancel: string;
        YesNoCancel: string;
        YesNo: string;
    };
    /** Result of a callback (using predefined buttons)
     * @alias Button
     * @enum {string}
     * @example _messageBox.Result.Ok;
     */
    var TDialogResults: {
        None: string;
        Ok: string;
        Cancel: string;
        Yes: string;
        No: string;
    };
    class MVVMDialog extends MVVM {
        private title;
        private dialogOptions;
        private buttons;
        private result;
        private callback;
        constructor(title: string, view: string, buttons: any, callback: any, opts?: IDialogOptions);
        private _show(fn?);
        getResult(): any;
        show(fn?: Function): void;
        hide(): void;
        buildButtons(button: any): any[];
        centerize(): void;
        isVisible(): boolean;
        destroy(): void;
        prepare(): void;
    }
}
declare module kit.manager {
    enum TSupportedLanguages {
        fr_FR = 0,
    }
    var SUPPORTED_LANGUAGES: {
        [key: string]: string;
    };
    class I18n extends BaseManager {
        uri: string;
        oListLocales: any;
        isStringsReady: KnockoutObservable<boolean>;
        localizedStrings: {
            [key: string]: string;
        };
        localizedObservableStrings: {
            [key: string]: KnockoutObservable<string>;
        };
        private static oLogger;
        /**
         * The current resources language.
         * @type {ko.observable(string)}
         */
        language: KnockoutObservable<string>;
        constructor(browserLanguageInfos: any);
        getCurrentLocale(): Locale;
        getLocale(isoCode: string): Locale;
        getSupportedLanguages(): any;
        loadStrings(lang?: string): void;
        private updateObservableStrings();
        getObservableString(key: string, defaultValue?: string): KnockoutObservable<string>;
        /**
         * Gets the localized string for the given key.
         * @param {string} key The key of the desired label.
         * @return {string} The localized string.
         */
        getString(key: string, defaultValue?: string): string;
        getCurrentLanguage(): string;
        getLanguageFromBrowser(): string;
        static getStringOrKey(str: string, key: string): string;
        getStringsUrl(language: string): string;
        init(): void;
    }
}
declare module kit {
    import Browser = helpers.Browser;
    import I18n = manager.I18n;
    class Application extends EventsBinder {
        title: KnockoutObservable<string>;
        isReady: KnockoutObservable<boolean>;
        version: string;
        manager: AppManager;
        logLevel: number;
        logConsole: boolean;
        useDialog: boolean;
        servicesPath: string;
        basePath: string;
        webkitPath: string;
        webkitLogUri: string;
        i18n: I18n;
        browser: Browser;
        context: IApplicationContext;
        userData: any;
        onAjaxSend: Function;
        constructor();
        getFinalFileName(fileName: string): string;
        navigateTo(href: string): void;
        postRedirect(url: string, data_post: any, target?: string, data_get?: any): void;
        ready(fn: Function, context?: any): void;
        /**
         * Affiche la bar pour acceptation des cookies
         */
        showCookieBar(options?: any): void;
        /**
         * Envoi d'un email
         */
        mailto(data: any): void;
        init(userData?: any): void;
    }
}
declare module kit.ui {
    interface IMessageBoxOptions extends IDialogOptions {
        icon?: string;
        id?: string;
    }
    interface IMessageBoxReturn {
        id: string;
        opts: IMessageBoxOptions;
        view: any;
        dialog: any;
    }
    class MessageBox extends MVVMDialog {
        private static _stringTemplate;
        private static _popinTemplate;
        private id;
        private dialog;
        private text;
        private icon;
        constructor(title: string, text: string, buttons?: any, callback?: any, opts?: IMessageBoxOptions);
        init(opts?: IMessageBoxOptions): void;
        getId(): string;
        /**
         * @Override
         */
        hide(): void;
        /** Show an alert dialog box with button 'OK'
         * @param {string} title - The box title
         * @param {string} text - The box content text
         * @param {function} callback - The function to call when the user push the 'OK' button
         * @param {object} [context=] - Context to use with the callback
         * @param {object} [options={icon:'warn'}] - dialog box options
         * @returns dialog object
         * @example MessageBox.alert('Hello', 'Hello world !', function() { //do action });
         */
        static alert(title: string, text: string, callback?: any, options?: IMessageBoxOptions): MessageBox;
        /** Show a confirm dialog box with buttons 'OK' and 'Cancel'
         * @param {string} title - The box title
         * @param {string} text - The box content text
         * @param {function} okCallback - The function to call when the user push the 'OK' button
         * @param {function} cancelCallback - The function to call when the user push the 'Cancel' button
         * @param {object} [context=] - Context to use with the callback
         * @param {object} [options={icon: 'help'}] - dialog box options
         * @returns dialog object
         * @example MessageBox.confirm('Hello', 'Hello world !', function() { //do action }, function() { //do action });
         * @example MessageBox.confirm('Hello', 'Hello world!', function(result) {
         *      if(result == _messageBox.Result.Ok) {
         *          // do Ok
         *      } else {
         *          // do Cancel
         *      }
         * };
         */
        static confirm(title: string, text: string, okCallback: any, cancelCallback?: any, options?: IMessageBoxOptions): MessageBox;
        /** Show a custom dialog box
         * @param {string} text - The box content text
         * @param {string} title - The box title
         * @param {array|Object|Enum=} [button=Button.Ok] - Button(s) to show
         * @param {function} callback - The function to call when the user push a button
         * @param {object} [context=] - Context to use with the callback
         * @param {object} [opts=] - dialog box options
         * @returns dialog object
         * @see oneesp.module.commons.messageBox#Alert
         * @see oneesp.module.commons.messageBox#Confirm
         * @example
         * /// Show an OkCancel message box
         * _messageBox.show('Hello world !', 'Hello', _messageBox.Button.OkCancel, function(result) {
         *      if(result == _messageBox.Result.Ok) {
         *          // do Ok
         *      } else {
         *          // do Cancel
         *      }
         * });
         * @example
         * // Show a message box with custom 'confirm' and 'unconfirm' buttons (labels will be autotrad based on the _i18n)
         * _messageBox.show('Hello world !', 'Hello',['confirm','unconfirm'], function(result) {
         *      if(result == 'confirm') {
         *          // do Confirm
         *      } else {
         *          // do Unconfirm
         *      }
         * });
         * @example
         * // Show a message box with custom 'confirm' and 'unconfirm' buttons (labels will be autotrad based on the _i18n)
         * var buttons = {'confirm':'Yes, I confirm', 'unconfirm':'No, I do not confirm'];
         * MessageBox.create('Hello world !', 'Hello', buttons, function(result) {
         *      if(result == 'confirm') {
         *          // do Confirm
         *      } else {
         *          // do Unconfirm
         *      }
         * });
         */
        static create(title: string, text: string, buttons: any, callback?: any, opts?: IMessageBoxOptions): MessageBox;
        /** Show a popin box
         * @param {string} text - The box content text
         * @param {string} [messageType='info'] - The message type ('info', 'error', 'warn')
         * @param {int} [timeout=2000] - The visibility delay before auto hide the popin in milliseconds (set to <code>0</code> to disable auto hide delay).
         * If not timeout is clearly specified, the popin will not be hidden when the <code>messageType</code> is equals to 'error'.
         * @example MessageBox.popin('Hello world !'); // Show an info popin during 2 seconds
         * @example MessageBox.popin('Hello world !', 'info', 0); // Show an info popin. Auto hide is disabled
         * @example MessageBox.popin('Hello world !', 'error'); // Show an error popin. Auto hide is disabled
         * @example MessageBox.popin('Hello world !', 'error', 1000); // Show an error popin during only 1 second
         */
        static popin(text: string, messageType?: string, timeout?: number): void;
    }
}
declare module kit.ui {
    interface IGlassPanelOptions {
        text?: string;
        progressionText?: string;
        currentStep?: number;
        totalSteps?: number;
    }
    class GlassPanel extends MVVM {
        private static oLogger;
        id: string;
        lockKeyBoard: boolean;
        isVisible: KnockoutObservable<boolean>;
        text: KnockoutObservable<string>;
        progressionText: KnockoutObservable<string>;
        currentStep: KnockoutObservable<number>;
        totalSteps: KnockoutObservable<number>;
        private progression;
        private steps;
        private animationDuration;
        animation: KnockoutObservable<any>;
        constructor(id: string, properties?: IGlassPanelOptions);
        private _update();
        update(properties: IGlassPanelOptions): void;
        load(): void;
        animate(animation: any, fn?: Function): void;
        show(fn?: Function): void;
        hide(fn?: Function): void;
        destroy(): void;
        /** Show an explicit glasspanel (using his ID)
         * @memberOf oneesp.manager.commons.glassPanel#
         * @param {string} ID - The ID specified
         * @returns {undefined}
         */
        static show(id?: string): void;
        /** Hide an explicit glasspanel (using his ID)
         * @memberOf oneesp.manager.commons.glassPanel#
         * @param {string} ID - The ID specified
         * @returns {undefined}
         */
        static hide(id?: string): void;
        /** Create a new glassPanel
         * @memberOf oneesp.manager.commons.glassPanel#
         * @param {string} text - The main text to show with the glassPanel
         * @param {object} [opts={ ID:'main' }] - The options of the glassPanel
         * @returns {undefined}
         * @example
         * // Show a glassPanel (will use the 'main' ID)
         * _glassPanel.create('Loading...'); // -> one glassPanel is showed
         * // Update the main glassPanel
         * _glassPanel.create('Loading again...'); // -> one glassPanel is showed
         * // Create a new glassPanel
         * _glassPanel.create('Wait...',{ ID: 'waitpanel' }); -> two glassPanel are showed
         * // Update the 'waitpanel' glassPanel
         * _glassPanel.create('Wait again...',{ ID: 'waitpanel' }); -> two glassPanel are showed
         * // Destroy the 'waitpanel' glassPanel
         * _glassPanel.destroy('waitpanel'); -> one glassPanel is showed (the main)
         * // Destroy the main glassPanel
         * _glassPanel.destroy(); -> no glassPanel is showed (equals to _glassPanel.destroy('main');)
         */
        static create(id?: string, opts?: IGlassPanelOptions): GlassPanel;
        /** Destroy a glassPanel
         * @memberOf oneesp.manager.commons.glassPanel#
         * @param {string} [ID='main'] - The ID of the glassPanel to destroy (destroy the main by default)
         * @returns {undefined}
         */
        static destroy(id?: string): void;
        static update(properties: IGlassPanelOptions, id?: string): void;
        /** Get an explicit glassPanel using his ID
         * @memberOf oneesp.manager.commons.glassPanel#
         * @param {string} [ID='main'] - The ID of the glassPanel to return (The main by default)
         * @returns {undefined}
         */
        static getPanel(id?: string): GlassPanel;
    }
}
declare module kit.fields {
    class Tooltip {
        uid: string;
        /**
         * The text.
         * @type {string}
         */
        text: KnockoutObservable<string>;
        show: KnockoutObservable<boolean>;
        animation: string;
        position: string;
        type: KnockoutObservable<string>;
        constructor(uid?: string);
        setText(resourceId: string, defaultId?: string): void;
    }
}
declare module kit.fields {
    interface IUIField {
        isReadOnly: KnockoutSubscribable<boolean>;
        isDisabled: KnockoutSubscribable<boolean>;
        isRequired: KnockoutSubscribable<boolean>;
        isVisible: KnockoutSubscribable<boolean>;
        isEditable: KnockoutSubscribable<boolean>;
        isLastInputValid: KnockoutSubscribable<boolean>;
        hasChanged: KnockoutSubscribable<boolean>;
        isFormValid: KnockoutSubscribable<boolean>;
        isFocused: KnockoutSubscribable<boolean>;
        hasBeenVisited: KnockoutSubscribable<boolean>;
        hasWarns: KnockoutSubscribable<boolean>;
        messages: KnockoutObservableArray<InputUIFieldMessage>;
        showMessages: KnockoutSubscribable<boolean>;
        applyChanges(): void;
        cancelChanges(): void;
        id: string;
        isEmpty(): KnockoutSubscribable<boolean>;
    }
    class BaseUIField extends EventsBinder implements IDisposable {
        /**
          * The parameter identifier.
          * @type {string}
          */
        id: string;
        /**
          * The parameter unique identifier.
          * @type {string}
          */
        uid: string;
        tooltip: Tooltip;
        /**
        * The label for this property.
        * @type {ko.observable<string>}
        */
        label: KnockoutObservable<string>;
        sub: KnockoutObservable<string>;
        formattedLabel: KnockoutComputed<string>;
        labelArgs: KnockoutObservable<any>;
        showLabel: KnockoutObservable<boolean>;
        constructor(id: string, bShowLabel?: boolean);
        formatLabel(label: string): string;
        dispose(): void;
    }
    /**
     * Constraint class for input validation rules
     */
    class InputUIFieldValidationConstraint implements IDisposable {
        name: string;
        fn: Function;
        isWarn: boolean;
        messageFn: Function;
        isValid: KnockoutComputed<boolean>;
        constructor(name: string, fn: Function, messageFn?: Function, isWarn?: boolean);
        dispose(): void;
    }
    class ValidationConstraintInfos {
        hasWarns: boolean;
        constructor();
    }
    /**
     * Constraint class for input validation rules
     */
    class InputUIFieldMessage {
        text: string;
        isWarn: boolean;
        constructor(text: string, isWarn?: boolean);
    }
    /**
     * A value for a property.
     * @param {Property} property The property.
     * @param {?(number|string)} value The value for this property.
     * @constructor
     */
    class InputUIField extends BaseUIField implements IUIField, IDisposable {
        static defaultShowMessages: boolean;
        /**
         * A value to not be equals to
         * @type string | array
         */
        wrongValue: any;
        /**
         * A value that indicates whether this field is read-only or read-write.
         * @type {boolean}
         */
        isReadOnly: KnockoutObservable<boolean>;
        isDisabled: KnockoutObservable<boolean>;
        isRequired: KnockoutObservable<boolean>;
        isVisible: KnockoutObservable<boolean>;
        isEditable: KnockoutObservable<boolean>;
        autoValidate: KnockoutObservable<boolean>;
        isEmpty: KnockoutObservable<boolean>;
        messages: KnockoutObservableArray<InputUIFieldMessage>;
        showMessages: KnockoutObservable<boolean>;
        /**
        * The value that indicates whether the field is focused
        * @type {ko.observable(boolean)}
        */
        isFocused: KnockoutObservable<boolean>;
        /**
         * The name attribute
         */
        name: KnockoutObservable<string>;
        /**
         * The validated value for this property.
         * @type {ko.observable(?(number|string))}
         */
        oldValue: KnockoutObservable<any>;
        /**
         * The validated value for this property.
         * @type {ko.observable(?(number|string))}
         */
        value: KnockoutSubscribable<any>;
        /**
         * The value that indicates whether the last input is valid.
         * @type {ko.observable(boolean)}
         */
        isLastInputValid: KnockoutObservable<boolean>;
        /**
         * The boolean value result controlled by an external process
         */
        externalValidationValue: KnockoutObservable<boolean>;
        /**
        * The value that indicates whether the value has changed.
        * @type {ko.observable(boolean)}
        */
        hasChanged: KnockoutComputed<boolean>;
        dataValue: KnockoutComputed<any>;
        /**
         * The value that indicates whether the field is valid.
         * @type {ko.observable(boolean)}
         */
        isFormValid: KnockoutComputed<boolean>;
        /**
         * The value that indicates is the field has warning messages
         * @type {ko.observable(boolean)}
         */
        hasWarns: KnockoutObservable<boolean>;
        /**
        * The value that indicates whether the field has been visited by user.
        * @type {ko.observable(boolean)}
        */
        hasBeenVisited: KnockoutObservable<boolean>;
        template: string;
        labelTemplate: string;
        inputTemplate: string;
        validationRule: KnockoutObservable<string>;
        validationConstraints: KnockoutObservableArray<InputUIFieldValidationConstraint>;
        unvalidatedConstraints: KnockoutObservableArray<InputUIFieldValidationConstraint>;
        dataName: string;
        private _onBlurEventDefer;
        private _validationRule;
        placeholder: KnockoutObservable<string>;
        constructor(id: string, value: any, required?: boolean, readOnly?: boolean);
        getValuable(): KnockoutSubscribable<any>;
        setValidationRegExp(regExp: RegExp): IValidationRule;
        valueIsEmpty(value: any): boolean;
        isValidateValue(value: any): boolean;
        /**
        * Validation function to trigger
        * @type {function()}
        */
        validateValue(): void;
        /**
         * Computes the value that indicates whether the value has changed.
         * @type {function():boolean}
         * @return boolean
         */
        private computeHasChanged();
        private computeIsFormValid();
        /**
         *
         */
        isValidateConstraintsValue(value: any, unvalidatedConstraints?: InputUIFieldValidationConstraint[], infos?: ValidationConstraintInfos): boolean;
        /**
         * Add a warn constraint validation rule
         */
        addWarnConstraint(name: string, fn: Function, messageFn?: Function): InputUIFieldValidationConstraint;
        /**
         * Add a constraint validation rule
         */
        addConstraint(name: string, fn: Function, messageFn?: Function, isWarn?: boolean): InputUIFieldValidationConstraint;
        getDataValue(): string;
        /**
         * Set value and apply changes in one call
         */
        forceValue(value: any): void;
        applyChanges(): void;
        cancelChanges(): void;
        onBlurEventHandler(e: Event): boolean;
        onFocusEventHandler(e: Event): boolean;
        dispose(): void;
    }
}
declare module kit.fields {
    enum TTextCase {
        none = 0,
        upper = 1,
        lower = 2,
        proper = 3,
    }
    class TextUIField extends InputUIField {
        maxLength: number;
        minLength: number;
        /**
         * The formatted Value
         */
        formattedValue: KnockoutComputed<string>;
        hasTextChanged: KnockoutComputed<boolean>;
        pattern: KnockoutObservable<string>;
        useFormat: KnockoutObservable<boolean>;
        defaultAutoValidationDelay: number;
        private _autoValidationDelay;
        private _previousAutoValidationTimeset;
        private _autoValidationTimecount;
        private _autoValidationCountset;
        private _autoValidationDelayTimeout;
        private _autoValidationCoeff;
        autoTrim: KnockoutObservable<boolean>;
        textCase: KnockoutObservable<TTextCase>;
        inputType: KnockoutObservable<string>;
        valueUpdateOn: KnockoutObservable<string>;
        constructor(id: string, value: any, required?: boolean, readOnly?: boolean);
        private _updateValue(v?);
        transform(value: string): string;
        formatValue(value: string): string;
        cleanFormatValue(value: string): string;
        getDataValue(): string;
        isValidateValue(value: any): boolean;
        private computeHasTextChanged();
        /**
         * Override
         */
        onFocusEventHandler(e: Event): boolean;
        onBlurEventHandler(e: Event): boolean;
        onKeyDownEventHandler(e: Event): boolean;
        onKeyUpEventHandler(e: Event): boolean;
        dispose(): void;
    }
}
declare module kit.fields {
    class TextSearchUIField extends TextUIField {
        constructor(id: string, value: any, required?: boolean, readOnly?: boolean);
        onSearch(): void;
    }
}
declare module kit.fields {
    class PasswordUIField extends TextUIField {
        constructor(id: string, value: any, required?: boolean, readOnly?: boolean);
    }
}
declare module kit.fields {
    class TextAreaUIField extends TextUIField {
        rows: KnockoutObservable<number>;
        scrollGlue: KnockoutObservable<boolean>;
        keyLock: KnockoutObservable<boolean>;
        constructor(id: string, value: any, required?: boolean, readOnly?: boolean);
        append(s: string): void;
        clear(): void;
        flush(): string;
        scrollToBottom(): void;
        isScrollToBottom(): boolean;
    }
}
declare module kit.fields {
    class ToggleUIField extends InputUIField {
        textForTrue: KnockoutObservable<string>;
        textForFalse: KnockoutObservable<string>;
        valueForTrue: string;
        valueForFalse: string;
        isChecked: KnockoutComputed<boolean>;
        constructor(id: string, valueForTrue: any, valueForFalse: any, required?: boolean, readOnly?: boolean);
        isValidateValue(value: any): boolean;
    }
}
declare module kit.fields {
    class LabelUIField extends InputUIField {
        className: KnockoutObservable<string>;
        constructor(id: string, value: any, required?: boolean);
    }
}
declare module kit.fields {
    enum TNumericTypes {
        Integer = 0,
        PositiveInteger = 1,
        Double = 2,
        PositiveDouble = 3,
    }
    class NumericUIField extends TextUIField {
        locale: KnockoutObservable<Locale>;
        minimum: number;
        maximum: number;
        isMinimumExcluded: boolean;
        isMaximumExcluded: boolean;
        unit: KnockoutObservable<string>;
        digits: number;
        text: KnockoutComputed<string>;
        /**
         * Constructor
         */
        constructor(id: string, value: any, formatType: TNumericTypes, required?: boolean, readOnly?: boolean);
        /**
         * Get the reg expression from a format type
         * @param the format type
         * @return the RegExp or undefined
         */
        private static getNumericRegExp(formatType);
        /**
         * Check if the value is validated, included commons controls
         * @param value the value to check
         * @return true or false
         * @override
         */
        isValidateValue(value: any): boolean;
        /**
         * Check constraints
         */
        isValidateConstraintsValue(value: any, unvalidatedConstraints?: InputUIFieldValidationConstraint[], infos?: ValidationConstraintInfos): boolean;
        /**
         * Format a value to display it
         * @param value the value to display
         * @return the formatted value
         * @override
         */
        formatValue(value: string): string;
        /**
         * Unformat a value seized by the user
         * @param value the value seized
         * @return the unformatted value
         * @override
         */
        cleanFormatValue(value: string): string;
        /**
         * Surcharge spécifique pour exclure les blancs de toute longueur.
         */
        valueIsEmpty(value: any): boolean;
    }
}
declare module kit.fields {
    class CurrencyUIField extends NumericUIField {
        constructor(id: string, value: any, required?: boolean, readOnly?: boolean);
    }
}
/**
 * @fileOverview This file defines the Option class.
 *     It requires jQuery and KnockOut libraries.
 */
declare module kit.fields {
    /**
     * An option in a select input.
     * @param {string} value The value.
     * @param {string} text The text.
     * @constructor
     */
    class Option {
        /**
         * The value.
         * @type {string}
         */
        value: string;
        resourceId: string;
        resourceTextId: string;
        data: any;
        tooltip: Tooltip;
        disabled: KnockoutObservable<boolean>;
        /**
         * The text.
         * @type {string}
         */
        text: KnockoutObservable<string>;
        constructor(value: string, resourceId?: string, resourceTextId?: string);
        static afterRenderFunction(option: any, item: Option): void;
    }
}
declare module kit.fields {
    class SelectUIField extends InputUIField {
        private choices;
        private outputValue;
        private valuableValue;
        private _valueToSet;
        private _valueToForce;
        options: KnockoutObservableArray<any>;
        view: KnockoutObservable<string>;
        inline: KnockoutObservable<boolean>;
        selectedOptionText: KnockoutObservable<string>;
        selectedOption: KnockoutObservable<Option>;
        private __optionsThrottle;
        private _oldChoicesStringified;
        constructor(id: string, choices: any, value: any, required?: boolean, readOnly?: boolean);
        /**
         * Validates the value for the property.
         * @param {?(number|string)} value The value for this property.
         * @type {function({?(number|string)})}
         */
        isValidateValue(value: any): boolean;
        getValuable(): KnockoutSubscribable<any>;
        /**
         * Set value and apply changes in one call
         */
        forceValue(value: any): void;
        /**
         * Construit une liste d'éléments Option
         */
        getListOfOptions(newChoices: any): Option[];
        addChoices(newChoices: any): void;
        removeChoices(oldchoices: any): void;
        /**
         * Update this select with the given choices.
         */
        updateChoices(newChoices: any): void;
        viewRadiosOptionClickFunction(option: Option, e: any): void;
        /**
         * Retourne si la liste contient la valeur
         */
        hasChoice(choice: string[]): boolean;
        hasChoice(choice: string): boolean;
        sort(compareFn?: (a: Option, b: Option) => number): Option[];
        private updateListOfChoices(options?);
        listCount(): number;
        /**
         * @Override
         */
        getDataValue(): string;
        /**
         * Sélectionne la première page.
         */
        selectFirst(): void;
        /**
         * @Override
         */
        dispose(): void;
    }
}
declare module kit.fields {
    class EmailUIField extends TextUIField {
        static EMAIL_LIST_DELIMITER: string;
        allowMultiple: KnockoutObservable<boolean>;
        constructor(id: string, value: any, required?: boolean, readOnly?: boolean);
        isValidateValue(value: any): boolean;
        getDataValue(): string;
    }
}
declare module kit.fields {
    class DateUIField extends TextUIField {
        minDate: KnockoutObservable<Date>;
        maxDate: KnockoutObservable<Date>;
        date: KnockoutComputed<Date>;
        constructor(id: string, value: any, required?: boolean, readOnly?: boolean);
        parseDate(value: string): Date;
        formatValue(value: string): string;
        cleanFormatValue(value: string): string;
        isValidateValue(value: string): boolean;
        isValidateConstraintsValue(value: string, unvalidatedConstraints?: InputUIFieldValidationConstraint[], infos?: ValidationConstraintInfos): boolean;
    }
}
declare module kit.fields.datemultifield {
    class DateTextFieldTypes {
        static day: DateTextFieldTypes;
        static month: DateTextFieldTypes;
        static year: DateTextFieldTypes;
        id: string;
        minLength: number;
        maxLength: number;
        minimum: number;
        maximum: number;
        placeHolder: string;
        constructor(id: string, placeHolder: string, minLength: number, maxLength: number, minimum?: number, maximum?: number);
    }
    class DateTextUIField extends NumericUIField {
        oNextUIField: TextUIField;
        private dateType;
        constructor(id: string, dateType: DateTextFieldTypes, oNextUIField?: TextUIField);
        /**
         * Format a value to display it
         * @param value the value to display
         * @return the formatted value
         * @override
         */
        formatValue(value: string): string;
        /**
         * Unformat a value seized by the user
         * @param value the value seized
         * @return the unformatted value
         * @override
         */
        cleanFormatValue(value: string): string;
        onKeyUpEventHandler(e: Event): boolean;
    }
}
declare module kit.fields {
    class DateMultiFieldUIField extends DateUIField {
        oTextUIFieldDay: datemultifield.DateTextUIField;
        oTextUIFieldMonth: datemultifield.DateTextUIField;
        oTextUIFieldYear: datemultifield.DateTextUIField;
        separator: KnockoutObservable<string>;
        private _koUpdateValue;
        private _koIsFocusedMainField;
        private _koComputeIsLastInputValid;
        private _koComputeYearIsValid;
        private _koComputeMonthIsValid;
        private _koComputeDayIsValid;
        constructor(id: string, value: any, required?: boolean, readOnly?: boolean);
        private broadcastEvents(uiField);
        /**
         * @Override cancelChanges
         */
        applyChanges(): void;
        /**
         * @Override cancelChanges
         */
        cancelChanges(): void;
        dispose(): void;
    }
}
declare module kit.fields {
    class CodePostalUIField extends InputUIField {
        oSelectUIField: SelectUIField;
        oTextUIField: TextUIField;
        isLoadingValues: KnockoutObservable<boolean>;
        sourceValueName: string;
        static onSearchFn: Function;
        constructor(id: string, value: any, required?: boolean, readOnly?: boolean);
        forceValue(value: string): void;
        /**
         * Override cancelChanges
         */
        cancelChanges(): void;
        /**
         * Override forceValue
         */
        forceValues(textValue: string, listValue: string): void;
        getTextDataValue(): string;
        getSelectedOptionLabel(): string;
        /**
         * Validates the value for the property.
         * @param {?(number|string)} value The value for this property.
         * @type {function({?(number|string)})}
         */
        isValidateValue(value: any): boolean;
    }
}
declare module kit.fields {
    class GridPasswordUIField extends InputUIField {
        oRandomChars: KnockoutComputed<string[]>;
        oObfuscatedPassword: KnockoutComputed<string>;
        oTabChars: KnockoutObservable<string>;
        oGridSize: KnockoutObservable<number>;
        oMaxLength: KnockoutObservable<number>;
        private sObfuscatedChar;
        /**
         * Constructeur
         */
        constructor(id: string, required?: boolean, gridSize?: number);
        /**
         * Evenement lors du clique sur un bouton
         */
        onClickChar(char: string): void;
        /**
         * @Override
         */
        isValidateValue(value: any): boolean;
        /**
         * Efface la saisie
         */
        clear(): void;
        /**
         * Annuler la dernière entrée
         */
        cancel(): void;
    }
}
/**
 * @fileOverview This file defines the UIField class.
 *     It requires jQuery and KnockOut libraries.
 */
declare module kit.fields {
    function getId(name: string, ind?: number): string;
    interface IValidationRule {
        test(value: any): boolean;
    }
    class RegExpValidationRule implements IValidationRule {
        private regExp;
        constructor(regExp: RegExp);
        test(value: any): boolean;
    }
    class ProgressBarUIField extends InputUIField {
        constructor(id: string, value: any);
        refresh(): void;
    }
    class StatusUIField extends LabelUIField {
        isRunning: KnockoutObservable<boolean>;
        constructor(id: string, value: any);
    }
    class CustomSelectUIField extends InputUIField {
        static CUSTOM_CHOICE: string;
        options: KnockoutObservableArray<any>;
        isCustomChoiceSelected: KnockoutObservable<boolean>;
        selectUIField: KnockoutObservable<SelectUIField>;
        customUIField: KnockoutObservable<InputUIField>;
        constructor(id: string, choices: any, value: any, required?: boolean, readOnly?: boolean, customUIField?: InputUIField);
        isCustomValue(v: string): boolean;
        cleanCustomValue(v: string): string;
        getCustomOption(): Option;
        hasCustomOption(): boolean;
        private addRemoveCustomChoice(bAdd);
        /**
         * Validates the value for the property.
         * @param {?(number|string)} value The value for this property.
         * @type {function({?(number|string)})}
         */
        isValidateValue(value: any): boolean;
        /**
         * Update this select with the given choices.
         */
        updateChoices(newChoices: any): void;
    }
    class AutoCompleteUIField extends TextUIField {
        valuesList: KnockoutObservableArray<any>;
        constructor(id: string, value: any, required?: boolean, readOnly?: boolean);
    }
    class SelectCondUIField extends SelectUIField {
        condUIField: InputUIField;
        condValue: string;
        constructor(id: string, condUIField: InputUIField, condValue: string, choices: any, value: any, required?: boolean, readOnly?: boolean);
        /**
         * Validates the value for the property.
         * @param {?(number|string)} value The value for this property.
         * @type {function({?(number|string)})}
         */
        isValidateValue(value: any): boolean;
    }
    class ActionUIField extends InputUIField {
        action: Function;
        constructor(id: string, label: string, action: Function, context?: any, readOnly?: boolean);
    }
}
declare module kit {
    import IUIField = fields.IUIField;
    import BaseUIField = fields.BaseUIField;
    import InputUIFieldMessage = fields.InputUIFieldMessage;
    class GroupUIField extends BaseUIField implements IUIField, IDisposable {
        oListOfUIField: KnockoutObservableArray<IUIField>;
        oListOfEnableNVisibleUIField: KnockoutComputed<IUIField[]>;
        oLengthOfListOfEnableNVisibleUIField: KnockoutComputed<number>;
        isLastInputValid: KnockoutSubscribable<boolean>;
        isDisabled: KnockoutSubscribable<boolean>;
        isReadOnly: KnockoutSubscribable<boolean>;
        isRequired: KnockoutSubscribable<boolean>;
        isEditable: KnockoutSubscribable<boolean>;
        isVisible: KnockoutSubscribable<boolean>;
        isFormValid: KnockoutSubscribable<boolean>;
        hasChanged: KnockoutSubscribable<boolean>;
        hasWarns: KnockoutSubscribable<boolean>;
        isEmpty: KnockoutSubscribable<boolean>;
        isFocused: KnockoutSubscribable<boolean>;
        messages: KnockoutObservableArray<InputUIFieldMessage>;
        showMessages: KnockoutSubscribable<boolean>;
        private oComputedMessages;
        private hasBeenVisitedTrigger;
        hasBeenVisited: KnockoutObservable<boolean>;
        constructor(id: string, PE_oListOfUIField?: IUIField[], bShowLabel?: boolean);
        addUIField(PE_oUIField: IUIField): void;
        private createComputedBoolean(subscribableName, testValue, allCombined?, throttle?);
        private createComputedMessages();
        private readBoolean(subscribableName, testValue?, allCombined?);
        private writeBoolean(subscribableName, v);
        private runFunction(functionName, args?);
        applyChanges(): void;
        cancelChanges(): void;
        /**
         * Libère correctement la mémoire
         */
        dispose(): void;
    }
}
declare module kit {
    import IUIField = fields.IUIField;
    class FieldsValidatorDigest extends GroupUIField implements IDisposable {
        private oComputed;
        messagesArgs: KnockoutObservable<any>;
        inspectChilds: KnockoutObservable<boolean>;
        constructor(PE_oListOfIUIField?: IUIField[], messagesArgs?: any, inspectChilds?: boolean);
        /**
         * Ajoute un champ au validateur
         */
        addField(field: IUIField): void;
        addUIFields(PE_oListOfIUIField?: IUIField[]): void;
        treatListOfFields(oListOfIUIFieldArray: IUIField[], messagesArgs: any, bRecursive: boolean): void;
        dispose(): void;
    }
}
declare module kit {
    import InputUIField = fields.InputUIField;
    class ScreenSequence extends GroupUIField {
        static defaultAnimationIn: any;
        static defaultAnimationOut: any;
        static defaultAnimationError: any;
        id: string;
        templateName: KnockoutObservable<string>;
        isSubmited: KnockoutObservable<boolean>;
        animationIn: any;
        animationOut: any;
        animationError: any;
        data: any;
        constructor(id: string, templateName: string, fields: InputUIField[], data?: any, animationIn?: any, animationOut?: any, animationError?: any);
        show(): boolean;
        hide(): boolean;
        beforeSubmit(): boolean;
        submit(): boolean;
        afterRender(): void;
    }
    class ScreenSequenceView extends ScreenSequence {
        isVisible: KnockoutObservable<boolean>;
        constructor(id: string, templateName: string, data?: any, animationIn?: any, animationOut?: any, animationError?: any);
    }
}
declare module kit {
    class Sequence extends EventsBinder {
        hashScreen: KnockoutObservable<string>;
        screens: KnockoutObservableArray<ScreenSequence>;
        transitionDelay: number;
        currentScreen: KnockoutObservable<ScreenSequence>;
        currentAnimation: KnockoutObservable<any>;
        schema: KnockoutComputed<ScreenSequence[]>;
        hasNext: KnockoutObservable<boolean>;
        hasPrevious: KnockoutObservable<boolean>;
        nextScreen: KnockoutObservable<ScreenSequence>;
        previousScreen: KnockoutObservable<ScreenSequence>;
        constructor(screens: ScreenSequence[], transitionDelay?: number);
        getScreenById(id: string): ScreenSequence;
        private updateDependencies(screen?);
        getFirstScreenToComplete(): ScreenSequence;
        link(pname: string, updateUri?: boolean, defaultScreenId?: any): string;
        /**
         * Start sequence
         */
        start(): boolean;
        refresh(): void;
        getFirstDependentScreenTo(screen: ScreenSequence): ScreenSequence;
        getCurrentIndexOfScreen(screen?: ScreenSequence): number;
        afterRender(): void;
        submit(): boolean;
        beforeNext(screen: ScreenSequence, next: ScreenSequence): boolean;
        next(): boolean;
        beforePrevious(screen: ScreenSequence, prev: ScreenSequence): boolean;
        previous(): boolean;
        findById(id: string): ScreenSequence;
        show(screen?: any): string;
    }
}
declare module kit {
    import InputUIField = fields.InputUIField;
    interface IDOMField {
        fields: InputUIField[];
        onDOMField(fieldType: string, name: string, field: InputUIField): any;
    }
}
declare module kit.agilitedigitale.components {
    abstract class DefaultBinding implements KnockoutBindingHandler {
        private name;
        options: any;
        constructor(name: string);
        getName(): string;
    }
}
declare module kit.agilitedigitale.components {
    import InputUIField = fields.InputUIField;
    class FieldBinding extends DefaultBinding {
        private static constructorList;
        constructor();
        static setConstructor(typeName: string, construct: Function): void;
        static getConstructor(typeName: string): Function;
        static construct(typeName: string, name: string, defaultValue: string, required: boolean): InputUIField;
        init(element: any, valueAccessor: any): void;
    }
}
declare module kit.agilitedigitale.components {
    class RegisterBindingsManager extends EventsBinder {
        register(binding: DefaultBinding): void;
    }
}
declare module kit.agilitedigitale.components {
    interface RegisterCallbacksInterface {
        create(domElement: HTMLElement): any;
        attach(domElement: HTMLElement): any;
        detach(domElement: HTMLElement): any;
        addAttribute(domElement: HTMLElement): any;
        removeAttribute(domElement: HTMLElement): any;
        modifyAttribute(domElement: HTMLElement): any;
    }
    abstract class DefaultElement implements RegisterCallbacksInterface {
        private tagName;
        constructor(tagName: string);
        getTagName(): string;
        abstract create(domElement: HTMLElement): any;
        attach(domElement: HTMLElement): void;
        detach(domElement: HTMLElement): void;
        addAttribute(domElement: HTMLElement): void;
        removeAttribute(domElement: HTMLElement): void;
        modifyAttribute(domElement: HTMLElement): void;
    }
}
declare module kit.agilitedigitale.components {
    class WebKitFieldElement extends DefaultElement {
        constructor();
        private createFieldFromHTMLElement(domElement);
        create(domElement: HTMLElement): void;
    }
}
interface Document {
    registerElement: Function;
}
declare module kit.agilitedigitale.components {
    class RegisterElementManager extends EventsBinder {
        register(def: DefaultElement): void;
    }
}
declare module kit.agilitedigitale.main {
}
/**
 * @fileOverview This file defines the post custom binding
 *      It requires jQuery and KnockOut libraries.
 */
declare module kit.bindings {
}
/**
 * @fileOverview This file defines the readonly custom binding.
 * 		It requires jQuery and KnockOut libraries.
 */
declare module kit.bindings {
}
/**
 * @fileOverview This file defines the datetimepicker custom binding.
 *     It requires jQuery and KnockOut libraries.
 */
declare module kit.bindings {
}
/**
 * @fileOverview This file defines the post custom binding
 *      It requires jQuery and KnockOut libraries.
 */
declare module kit.bindings {
}
/**
 * @fileOverview This file defines the accordion custom binding
 *		It requires jQuery and KnockOut libraries.
 */
declare module kit.bindings {
}
/**
 * @fileOverview This file defines the format custom binding
 *		It requires jQuery and KnockOut libraries.
 */
declare module kit.bindings {
    var format: (content: any) => string;
}
/**
 * @fileOverview This file defines the format custom binding
 *		It requires jQuery and KnockOut libraries.
 */
declare module kit.bindings {
}
/**
 * @fileOverview This file defines the post custom binding
 *      It requires jQuery and KnockOut libraries.
 */
declare module kit.bindings {
}
/**
 * @fileOverview This file defines the load custom binding
 *      It requires jQuery and KnockOut libraries.
 */
declare module kit.bindings {
}
/**
 * @fileOverview This file defines the loadMention custom binding
 *      It requires jQuery and KnockOut libraries.
 */
declare module kit.bindings {
}
/**
 * @fileOverview This file defines the inputType
 *      It requires jQuery and KnockOut libraries.
 */
declare module kit.bindings {
}
