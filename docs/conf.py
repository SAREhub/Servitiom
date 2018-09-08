master_doc = 'index'

project = u'Servitiom'
copyright = u'2018, SARE SA'

html_show_sphinx = False
html_static_path = [
'assets/'
]
html_context = {
 'css_files': [
  'https://media.readthedocs.org/css/sphinx_rtd_theme.css',
  'https://media.readthedocs.org/css/readthedocs-doc-embed.css',
  '_static/css/extra.css',
 ]
}

latex_documents = [
  (master_doc, 'index.tex', u'Servitiom',
   u'SARE SA', 'manual', True),
]