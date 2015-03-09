import re
import collections
from Bio import trie

SOURCE_DIR = 'data/orig_data'
OUTPUT_DIR = 'data/rel_data'


#regular expressions for each line of a movie entry
regex = {'title' : r"\t(.+)",
         'year' : r"\t(\d+)", #year has 4 digits
         'runtime' : r"\t(\d+)",
         'mpaa' : r"\t(\w{1,4})", #longest letter combo is pg13
         'keywords' : r"\t([^\t\n]+)", #each entry is preceded by a tab
         'producers' : r"\t([^\t\n]+)",
         'directors' : r"\t([^\t\n]+)",
         'editors' : r"\t([^\t\n]+)",
         'actor' : r"(?P<type>Actor|Actress)\t(?P<name>[^\t]+)\t(?P<role>[^\t\n]+)"
        }
             
def findCase(line):
  if line.startswith('Title'):
    return 'title'
  elif line.startswith('Year'):
    return 'year'
  elif line.startswith('Running Time'):
    return 'runtime'
  elif line.startswith('MPAA Rating'):
    return 'mpaa'
  elif line.startswith('Key Words'):
    return 'keywords'
  elif line.startswith('Producers'):
    return 'producers'
  elif line.startswith('Directors'):
    return 'directors'
  elif line.startswith('Editors'):
    return 'editors'
  elif line.startswith('Actor') or line.startswith('Actress'):
    return 'actor'
  
def strDict(orderedDict):
  output = ''
  for key in orderedDict:
    output += str(orderedDict[key]) + '\t'
  return output

def createActObj():
  #actObj = {'pro_name' : '', 'title' : '', 'year' : '', 'role' : ''}
  actObj = collections.OrderedDict()
  actObj['pro_name'] = ''
  actObj['title'] = ''
  actObj['year'] = ''
  actObj['role'] = ''
  return actObj
  
def createProObj(name, gender=''):
  #proObj = {'name' : '', 'gender' : ''}
  proObj = collections.OrderedDict()
  proObj['name'] = name
  proObj['gender'] = gender
  return proObj
  
def createMovieObj():
  #movieObj = {'title' : '', 'year' : '', 'runtime' : ''}
  movieObj = collections.OrderedDict()
  movieObj['mid'] = 'NULL'
  movieObj['title'] = ''
  movieObj['year'] = ''
  movieObj['runtime'] = ''
  return movieObj
  
def createMPAAObj(mpaa, movie):
  mpaaObj = collections.OrderedDict()
  mpaaObj['title'] = movie['title']
  mpaaObj['year'] = movie['year']
  mpaaObj['mpaa'] = mpaa
  return mpaaObj
  
def createKeyObj(keyword, movie):
  #keyObj = {'keyword' : '', 'title': '', 'year' : ''}
  keyObj = collections.OrderedDict()
  keyObj['keyword'] = keyword
  keyObj['title'] = movie['title']
  keyObj['year'] = movie['year']
  return keyObj

def zipKeyObjs(keywords, movieObj):
  objs = []
  for k in keywords:
    kobj = createKeyObj(k, movieObj)
    objs.append(kobj)
    
  return objs
  
def createNameObj(name, movie):
  #editObj = {'name' : '', 'title' : '', 'year' : ''}
  editObj = collections.OrderedDict()
  editObj['name'] = name
  editObj['title'] = movie['title']
  editObj['year'] = movie['year']
  return editObj  

def zipNameObjs(names, movieObj):
  objs = []
  for n in names:
    nobj = createNameObj(n, movieObj)
    objs.append(nobj)
    
  return objs

#example order w/ everything --> $windle
#has to have: title, year lines
#may or may not have: runtime, key words, mpaa rating

#x = re.match(mregex, mline)
#x.groupdict()
log = False
profList = trie.trie()

with open('%s/movies.txt' % SOURCE_DIR, 'r', encoding='latin-1') as inFile, open('%s/movies_formatted.txt' % OUTPUT_DIR, 'w+') as movFile, open('%s/professional_formatted.txt' % OUTPUT_DIR, 'w+') as profFile, open('%s/keywords_formatted.txt' % OUTPUT_DIR, 'w+') as keyFile,open('%s/directs_formatted.txt' % OUTPUT_DIR, 'w+') as dirFile,open('%s/produces_formatted.txt' % OUTPUT_DIR, 'w+') as prodFile,open('%s/edits_formatted.txt' % OUTPUT_DIR, 'w+') as edFile,open('%s/actsIn_formatted.txt' % OUTPUT_DIR, 'w+') as actRelFile, open('%s/mpaa_formatted.txt' % OUTPUT_DIR, 'w+') as mpaaFile:
  #movFile, profFile, keyFile, 
  #dirFile, prodFile, edFile, actRelFile,
  #mpaaFile
  
  movieObj = None
  for line in inFile:
    case = findCase(line)
    if log:
      print('---CASE---\n%s\n-------------\n' % case)
    
    if case == 'title':
      if(movieObj):
        movFile.write('\t'.join(movieObj.values()) + '\n')
        movFile.flush()
      movieObj = createMovieObj()
      movieObj['title'] = re.findall(regex['title'], line)[0]
      if log:
        print('***%s***' % movieObj['title'])
      else:
        print("(Title, Year) = (%s, %s)" % (movieObj['title'], movieObj['year']))
    elif case == 'year':
      movieObj['year'] = re.findall(regex['year'], line)[0]
      if log:
        print('Year: %s' % movieObj['year'])           
    elif case == 'runtime':
      movieObj['runtime'] = re.findall(regex['runtime'], line)[0]
      if log:
        print('runtime: %s' % movieObj['runtime'])       
    elif case == 'mpaa':
      mpaa = re.findall(regex['mpaa'], line)[0]
      mpaaObj = createMPAAObj(mpaa, movieObj)
      mpaaFile.write('\t'.join(mpaaObj.values()) + '\n')
      if log:
        print('mpaa: %s' % mpaa)  
    elif case == 'keywords':
      keywords = re.findall(regex['keywords'], line)
      keyObjs = zipKeyObjs(keywords, movieObj)
      for k in keyObjs:
        keyFile.write('\t'.join(k.values()))
        keyFile.write('\n')
      if log:
        print('keywords: ' + ','.join(keywords))      
    elif case == 'producers':
      producers = re.findall(regex['producers'], line)
      prodObjs = zipNameObjs(producers, movieObj)
      for p in prodObjs:
        prodFile.write('\t'.join(p.values()))
        prodFile.write('\n')
        
        proObj = createProObj(p['name'])
        profFile.write('\t'.join(proObj.values()) + '\n')
      if log:
        print('producers: ' + ','.join(producers))             
    elif case == 'directors':
      directors = re.findall(regex['directors'], line)
      dirObjs = zipNameObjs(directors, movieObj)
      for d in dirObjs:
        dirFile.write('\t'.join(d.values()))
        dirFile.write('\n')
        
        proObj = createProObj(d['name'])
        profFile.write('\t'.join(proObj.values()) + '\n')
      if log:
        print('directors: ' + ','.join(directors))         
    elif case == 'editors':
      editors = re.findall(regex['editors'], line)
      editObjs = zipNameObjs(editors, movieObj)
      for e in editObjs:
        edFile.write('\t'.join(e.values()))
        edFile.write('\n')
        
        proObj = createProObj(e['name'])
        profFile.write('\t'.join(proObj.values()) + '\n')
        
      if log:
        print('editors: ' + ','.join(editors))             
    elif case == 'actor':
      #proObj = createProObj()
      actObj = createActObj()
      
      m = re.match(regex['actor'], line).groupdict()
      proObj = createProObj(m['name'], 'M' if m['type'] == 'Actor' else 'F')
      actObj['pro_name'] = m['name']
      actObj['role'] = m['role']
      actObj['title'] = movieObj['title']
      actObj['year'] = movieObj['year']
      
      #if(not proObj['name'] in profList):
      #  profList[proObj['name']] = proObj['name']
      profFile.write('\t'.join(proObj.values()) + '\n')
      profFile.flush()
      #else:
      if log:
        #print('--DUPLICATE--')
        print(proObj)
      actRelFile.write('\t'.join(actObj.values()) + '\n')
      actRelFile.flush()
      
      if log:
        print('actor obj: %s' % str(actObj))
        print('pro obj: %s' % str(proObj))  
              
    else:
      if log:
        print('invalid case')
    
  #write out last line
  if(movieObj):
    movFile.write('\t'.join(movieObj.values()) + '\n')
    movFile.flush()
      
      
    
