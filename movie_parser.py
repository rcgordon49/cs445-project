import re

SOURCE_DIR = 'data/orig_data'
OUTPUT_DIR = 'data/rel_data'


#regular expressions for each line of a movie entry
regex = {'title' : r"\t(.+)",
         'year' : r"\t(\d{4})", #year has 4 digits
         'runtime' : r"\t(\d+)",
         'mpaa' : r"\t(\w{1,4})", #longest letter combo is pg13
         'keywords' : r"\t([^\t]+)", #each entry is preceded by a tab
         'producers' : r"\t([^\t]+)",
         'directors' : r"\t([^\t+])",
         'editors' : r"\t([^\t]+)",
         'actor' : r"(?P<type>Actor|Actress)\t(?P<name>[^\t]+)\t(?P<role>[^\t]*)"
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
  

#example order w/ everything --> $windle
#has to have: title, year lines
#may or may not have: runtime, key words, mpaa rating

#x = re.match(mregex, mline)
#x.groupdict()
log = True

with open('%s/movies.txt' % SOURCE_DIR, 'r') as inFile, open('%s/movies_formatted.txt' % OUTPUT_DIR, 'w+') as movFile, open('%s/professional_formatted.txt' % OUTPUT_DIR, 'w+') as profFile, open('%s/keywords_formatted.txt' % OUTPUT_DIR, 'w+') as keyFile,open('%s/directs_formatted.txt' % OUTPUT_DIR, 'w+') as dirFile,open('%s/produces_formatted.txt' % OUTPUT_DIR, 'w+') as prodFile,open('%s/edits_formatted.txt' % OUTPUT_DIR, 'w+') as edFile,open('%s/actsIn_formatted.txt' % OUTPUT_DIR, 'w+') as actRelFile:
  #movFile, profFile, keyFile, dirFile, prodFile, edFile, actRelFile
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
      if log: print('keyword')
    
    elif case == 'producers':
      if log: print('producers')
      
    elif case == 'directors':
      if log: print('directors')
      
    elif case == 'editors':
      if log: print('editors')
      
    elif case == 'actor':
      proObj = {'name' : '', 'gender' : ''}
      actObj = {'pro_name' : '', 'title' : '', 'year' : '', 'role' : ''}
      
      m = re.match(regex['actor'], line).groupdict()
      proObj['name'] = m['name']
      proObj['gender'] = 'M' if m['type'] == 'Actor' else 'F'
      actObj['pro_name'] = m['name']
      actObj['role'] = m['role']
      
      profFile.write('\t'.join(proObj.values()) + '\n')
      profFile.flush()
      actRelFile.write('\t'.join(actObj.values()) + '\n')
      actRelFile.flush()
      
      if log:
        print('actor obj: %s' % str(actObj))
        print('pro obj: %s' % str(proObj))
      
      
      
    
