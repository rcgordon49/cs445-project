import re
import collections

SOURCE_DIR = 'data/orig_data'
OUTPUT_DIR = 'data/rel_data'


#regular expressions for each line of a movie entry
regex = {'title' : r"\t(.+)",
         'year' : r"\t(\d+)", #year has 4 digits
         'runtime' : r"\t(\d+)",
         'mpaa' : r"\t(\w{1,4})", #longest letter combo is pg13
         'keywords' : r"\t([^\t]+)", #each entry is preceded by a tab
         'producers' : r"\t([^\t]+)",
         'directors' : r"\t([^\t+])",
         'editors' : r"\t([^\t]+)",
         'actor' : r"(?P<type>Actor|Actress)\t(?P<name>[^\t]+)\t(?P<role>[^\t]+)"
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
  

def createActObj():
  #actObj = {'pro_name' : '', 'title' : '', 'year' : '', 'role' : ''}
  actObj = collections.OrderedDict()
  actObj['pro_name'] = ''
  actObj['title'] = ''
  actObj['year'] = ''
  actObj['role'] = ''
  return actObj
  
def createProObj():
  #proObj = {'name' : '', 'gender' : ''}
  proObj = collections.OrderedDict()
  proObj['name'] = ''
  proObj['gender'] = ''
  return proObj

#example order w/ everything --> $windle
#has to have: title, year lines
#may or may not have: runtime, key words, mpaa rating

#x = re.match(mregex, mline)
#x.groupdict()
log = True
profList = []

with open('%s/movies.txt' % SOURCE_DIR, 'r', encoding='latin-1') as inFile, open('%s/movies_formatted.txt' % OUTPUT_DIR, 'w+') as movFile, open('%s/professional_formatted.txt' % OUTPUT_DIR, 'w+') as profFile, open('%s/keywords_formatted.txt' % OUTPUT_DIR, 'w+') as keyFile,open('%s/directs_formatted.txt' % OUTPUT_DIR, 'w+') as dirFile,open('%s/produces_formatted.txt' % OUTPUT_DIR, 'w+') as prodFile,open('%s/edits_formatted.txt' % OUTPUT_DIR, 'w+') as edFile,open('%s/actsIn_formatted.txt' % OUTPUT_DIR, 'w+') as actRelFile:
  #movFile, profFile, keyFile, 
  #dirFile, prodFile, edFile, actRelFile
  for line in inFile:
    case = findCase(line)
    
    if case == 'title':
      movieObj = {'title' : '', 'year' : '', 'runtime' : '', 'mpaa' : ''}
      movieObj['title'] = re.findall(regex['title'], line)[0]
      if log: print('***%s***' % movieObj['title'])
      
    elif case == 'year':
      movieObj['year'] = re.findall(regex['year'], line)[0]
      if log: print('Year: %s' % movieObj['year'])
      
    elif case == 'runtime':
      movieObj['runtime'] = re.findall(regex['runtime'], line)[0]
      if log: print('runtime: %s' % movieObj['runtime'])
      
    elif case == 'mpaa':
      movieObj['mpaa'] = re.findall(regex['mpaa'], line)[0]
      if log: print('mpaa: %s' % movieObj['mpaa'])
   
    elif case == 'keywords':
      keywords = re.findall(regex['keywords'], line)
      keyFile.write('\n'.join(keywords))
      if log: print(','.join(keywords))
    
    elif case == 'producers':
      producers = re.findall(regex['producers'], line)
      keyFile.write('\n'.join(producers))
      if log: print(','.join(producers))
      
    elif case == 'directors':
      directors = re.findall(regex['directors'], line)
      keyFile.write('\n'.join(directors))
      if log: print(','.join(directors))
      
    elif case == 'editors':
      editors = re.findall(regex['editors'], line)
      keyFile.write('\n'.join(editors))
      if log: print(','.join(editors))
      
    elif case == 'actor':
      proObj = createProObj()
      actObj = createActObj()
      
      m = re.match(regex['actor'], line).groupdict()
      proObj['name'] = m['name']
      proObj['gender'] = 'M' if m['type'] == 'Actor' else 'F'
      actObj['pro_name'] = m['name']
      actObj['role'] = m['role']
      actObj['title'] = movieObj['title']
      actObj['year'] = movieObj['year']
      
      if(not proObj in profList):
        profList.append(proObj)
        profFile.write('\t'.join(proObj.values()) + '\n')
        profFile.flush()
      else:
        print('--DUPLICATE--')
        print(proObj)
      actRelFile.write('\t'.join(actObj.values()) + '\n')
      actRelFile.flush()
      
      if log:
        print('actor obj: %s' % str(actObj))
        print('pro obj: %s' % str(proObj))
        
    else:
      print('invalid case')
      
      
      
    
