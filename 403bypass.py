from burp import IBurpExtender
from burp import IHttpListener
from burp import IHttpRequestResponse
from burp import IRequestInfo
from burp import IResponseInfo
from burp import IExtensionHelpers

class Bypass403Extension(IBurpExtender, IHttpListener):
    def __init__(self):
        self.helpers = None

    def registerExtenderCallbacks(self, callbacks):
        # Set the extension name
        callbacks.setExtensionName("Bypass 403 Extension")

        # Obtain an extension helpers object
        self.helpers = callbacks.getHelpers()

        # Register ourselves as an HTTP listener
        callbacks.registerHttpListener(self)

    def processHttpMessage(self, toolFlag, messageIsRequest, messageInfo):
        if not messageIsRequest:
            # We are only interested in responses
            response = self.helpers.analyzeResponse(messageInfo.getResponse())
            if response.getStatusCode() == 403:
                # Modify the User-Agent header in the request
                request = messageInfo.getRequest()
                requestInfo = self.helpers.analyzeRequest(request)
                headers = requestInfo.getHeaders()

                for i in range(len(headers)):
                    if headers[i].startsWith("User-Agent:"):
                        headers[i] = "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3"
                        break

                # Rebuild the request
                newRequest = self.helpers.buildHttpMessage(headers, requestInfo.getBody())
                messageInfo.setRequest(newRequest)

                # Resend the modified request
                self.helpers.sendRequest(messageInfo)
