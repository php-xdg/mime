<?php declare(strict_types=1);

use ju1ius\XdgMime\Runtime\XmlNamespacesDatabase;

return new XmlNamespacesDatabase([
    'http://www.w3.org/1998/Math/MathML' => ['math' => 'application/mathml+xml'],
    'http://www.metalinker.org/' => ['metalink' => 'application/metalink+xml'],
    'urn:ietf:params:xml:ns:metalink' => ['metalink' => 'application/metalink4+xml'],
    'http://xspf.org/ns/0/' => ['playlist' => 'application/xspf+xml'],
    'http://www.w3.org/2001/SMIL20/Language' => ['smil' => 'application/smil+xml'],
    'http://www.w3.org/2005/SMIL21/Language' => ['smil' => 'application/smil+xml'],
    'http://www.w3.org/ns/SMIL' => ['smil' => 'application/smil+xml'],
    'http://www.apple.com/DTDs/PropertyList-1.0.dtd' => ['plist' => 'application/x-apple-systemprofiler+xml'],
    'urn:oasis:names:tc:xliff:document:1.1' => ['xliff' => 'application/xliff+xml'],
    'http://www.opengis.net/gml/3.2' => ['gml' => 'application/gml+xml'],
    'http://www.abisource.com/awml.dtd' => ['abiword' => 'application/x-abiword'],
    'http://www.gribuser.ru/xml/fictionbook/2.0' => ['FictionBook' => 'application/x-fictionbook+xml'],
    'http://www.lysator.liu.se/~alla/dia/' => ['diagram' => 'application/x-dia-diagram'],
    'http://www.daa.com.au/~james/dia-shape-ns' => ['shape' => 'application/x-dia-shape'],
    'http://www.w3.org/1999/xhtml' => ['html' => 'application/xhtml+xml'],
    'http://www.w3.org/2000/svg' => ['svg' => 'image/svg+xml'],
    'http://www.w3.org/1999/02/22-rdf-syntax-ns#' => ['RDF' => 'application/rdf+xml'],
    'http://www.w3.org/2002/07/owl#' => ['Ontology' => 'application/owl+xml'],
    'http://www.w3.org/2005/Atom' => ['feed' => 'application/atom+xml'],
    'http://schema.omg.org/spec/XMI/2.0' => ['XMI' => 'text/x-xmi'],
    'http://schema.omg.org/spec/XMI/2.1' => ['XMI' => 'text/x-xmi'],
    'http://www.w3.org/1999/XSL/Format' => ['root' => 'text/x-xslfo'],
    'http://www.w3.org/1999/XSL/Transform' => ['stylesheet' => 'application/xslt+xml'],
    'http://www.opengis.net/kml/2.2' => ['kml' => 'application/vnd.google-earth.kml+xml'],
    'http://www.topografix.com/GPX/1/0' => ['gpx' => 'application/gpx+xml'],
    'http://www.topografix.com/GPX/1/1' => ['gpx' => 'application/gpx+xml'],
    'http://www.mozilla.org/keymaster/gatekeeper/there.is.only.xul' => ['window' => 'application/vnd.mozilla.xul+xml'],
    'http://www.w3.org/2005/sparql-results#' => ['sparql' => 'application/sparql-results+xml'],
]);