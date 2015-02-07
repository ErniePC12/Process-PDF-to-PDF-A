# Process-PDF-to-PDF-A
This is a simple program that will scan for PDF documents and convert them to PDF/A format using Ghost Script.

I am running this on a OS X 10.10 Server.  

MacPorts is installed, and I used that to install Ghost Script.


# The Story

When posting a document to the US Courts CM/ECF system, you are required to save the PDF as a PDF/A, or Archived PDF.  For reasons not understood, we have been running into an issue where some fonts do not want to get embedded into the PDF.

This work around is set to run automatically to scan a directory, or set of directories, and automatically convert a PDF to a PDF/A-1 format.  This action will also flatten the document as well.


## Notes
I have some settings that are set in a different file, and I reference them in this main file, but because of the sensitive nature of what I do, I can't post them.